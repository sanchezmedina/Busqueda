<?php
require_once 'Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();

$cod_favor_ju = $_REQUEST['cod_favor_ju'];
$nombre = $_REQUEST['nombre'];
//  Datos del Favorecido
$nombre_fav = $_REQUEST['nombre_favor'];
$paterno = $_REQUEST['paterno'];
$materno = $_REQUEST['materno'];


$query = "SELECT cod_sct FROM escrifavor1 WHERE cod_inv_ju = '$cod_favor_ju';";
$result = mysql_query($query);
$num = mysql_num_rows($result);
if ($num > 0) {
    ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <link rel="stylesheet" type="text/css" href="css/busquedas.css"/>
            <title>Busqueda</title>
            <script language="javascript" type="text/javascript">
                function muestra(cod_fav_ju, cod_sct, cod_oto, cod_inv_ju ){
                    location.href="buscarSct_x_Fecha.php?cod_favor_ju="+cod_fav_ju+"&cod_otor="+cod_oto+"&cod_sct="+cod_sct+"&cod_otor_ju="+cod_inv_ju+"";
                }
            </script>
        </head>
        <body>
            <p>BUSQUEDA POR FAVORECIDO <?php echo "Existe(n): " . $num . " Favorecidos"; ?></p>

            <form action="" name="busqueda_favoredico" method="get">
                <table width="665" border="0">
                    <thead>
                        <tr>
                            <td width="581"><input name="regresar" type="button" class="boton" onclick="javascript:location.href='./buscar_favor_juri.php'" value="Regresar" /></td>
                            <td width="74"><input type="submit" name="Submit" value="Buscar" /></td>
                        </tr>
                        <tr>
                            <td colspan="2">Favorecido: <?php echo $nombre; ?></td>
                        </tr>
                    </thead>
                </table>
            </form>


            <table width="1071" border="0">
                <thead>
                    <tr>
                        <td width="55" class="error">Escritura</td>
                        <td width="470" class="error">Otorgante</td>
                        <td width="103" class="error">Fecha</td>
                        <td width="27" class="error">SubSerie</td>
                        <td width="124" class="error">Prebio /Bien </td>
                        <td width="76" class="error">Protocolo</td>
                        <td width="129" class="error">Escritura</td>
                        <td width="129" class="error">Folio</td>
                    </tr>
                </thead>
                <?php
                $i = 1;
                while (@$fila2 = mysql_fetch_array($result)) {
                    $Escritura = $fila2[0];
                    $query_sct = "SELECT cod_sct, cod_inv, cod_inv_ju FROM escriotor1 WHERE cod_sct = '$Escritura';";
                    $query1 = mysql_query($query_sct);
                    $res1 = mysql_fetch_array($query1);
                    $var0 = $res1[0];
                    $var1 = $res1[1];
                    $var2 = $res1[2];

                    $query2 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras1 WHERE cod_sct = '$Escritura';";
                    $result2 = mysql_query($query2);
                    $fila = mysql_fetch_array($result2);
                    $datosEscritura = array("cod_sct" => $fila[0], "notario" => $fila[1], "escritura" => $fila[2], "distrito" => $fila[3], "fecha" => $fila[4], "subserie" => $fila[5], "bien" => $fila[6], "cantFolios" => $fila[7], "protocolo" => $fila[8], "obs" => $fila[9], "numFolios" => $fila[10]);
                    $Escritura2 = $datosEscritura["cod_sct"];
                    ?>
                    <tr bgcolor="#F0ECCE" onMouseOver="this.style.backgroundColor='#4499CC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#F0ECCE';" onClick="javascript:muestra('<?php echo $cod_favor_ju; ?>','<?php echo $Escritura2; ?>','<?php echo $var1; ?>', '<?php echo $var2; ?>');">
                        <td><?php echo $i; ?></td>
                        <td>
        <?php
        $q_fav = "SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv) AS persona, b.Cod_inv, b.Raz_inv FROM involucrados1 as a, involjuridicas1 as b WHERE a.cod_inv = '$var1'";
        $query22 = mysql_query($q_fav) or die(mysql_error() . " Error Buscado Favorecido");
        $r2 = mysql_fetch_array($query22);
        echo $r2["persona"];
        if ($var2 <> 0) {
            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$var2'";
            $QUERY2 = mysql_query($RESULT2);
            $FILA2 = mysql_fetch_array($QUERY2);
            echo $FILA2[1];
        }
        ?>	</td>
                        <td><?php echo $datosEscritura["fecha"]; ?></td>
                        <td><?php
                    $sub = $datosEscritura["subserie"];
                    /* @var $datosEscritura <type> */
                    $Sis = "SELECT des_sub FROM subseries WHERE cod_sub = '$sub'";
                    $Sis1 = mysql_query($Sis);
                    $Sto = mysql_fetch_array($Sis1);
                    echo $Sto[0];
        ?></td>
                        <td><?php echo $datosEscritura["bien"]; ?></td>
                        <td><?php echo $datosEscritura["protocolo"]; ?></td>
                        <td><?php echo $datosEscritura["escritura"]; ?>    </td>
                        <td width="51" class="Estilo1"><?php echo $datosEscritura["numFolios"]; ?></td>
                    </tr>
                    <?php
                    $i = $i + 1;
                }
                ?>

                <tr>

                </tr>
            </table>
            <?php
        } else {
            echo "<script language='javascript' type='text/javascript'>alert('No hay Escrituras que Mostrar.  Volver Atras');history.back(-1);</script>";
        }
        ?>
    </body>
</html>