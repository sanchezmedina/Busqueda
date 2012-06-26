<?php
require_once 'Model/conexion.class.php';
$link = new conexionclass();
$link->conectarse();

//Obtener el Numero de Escritura
$cod_otor = $_REQUEST['cod_otor'];
echo $cod_otor;
echo "<br>";
$consult = "SELECT cod_sct FROM escriotor1 WHERE cod_inv = $cod_otor";
$query = mysql_query($consult);
$dato = mysql_fetch_array($query);
$cod_sct = $dato[0];
echo $cod_sct;


//Obtener el Codigo del Favorecido
$consult1 = "select cod_inv from escrifavor1 where cod_sct = $cod_sct";
$query1 = mysql_query($consult1);
@$dato1 = mysql_fetch_array($query1);

$cod_fav = $dato1[0];

//
$consult2 = "SELECT cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu FROM escrituras1 WHERE cod_sct = $cod_sct";
$query2 = mysql_query($consult2);
$dato2 = mysql_fetch_array($query2);
$ver = array("Notario" => $dato2[0], "Escritura" => $dato2[1], "Distrito" => $dato2[2], "Fecha" => $dato2[3], "SubSerie" => $dato2[4], "NBien" => $dato2[5], "NumFolios" => $dato2[6], "Protocolo" => $dato2[7], "Obs" => $dato2[8], "Folio" => $dato2[9], "Usuario" => $dato2[10]);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=es-iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="../../css/style_ingreso.css"></link>
        <title>Busqueda de Escrituras - ARP</title>
        <style type="text/css">
            <!--
            .Estilo6 {color: #FFFFFF}
            .Estilo5 {color: #CCCCCC}
            .style15 {color: #FFFFFF; font-weight: bold; font-size: 17px; }
            -->
        </style>
    </head>

    <script language="javascript" type="text/javascript">
        function enviar_datos(){
            var cod_otor = document.getElementById("cod_otor").value;
            alert('Dato Agregado Correctamente');
            window.close();
            location.href("./ingreso.php?otorgante=" + cod_otor + "");
        }
    </script>

    <body>
        <table width="200" border="1" align="center">
            <tr>
                <td><img src="../imagenes/bus.png" alt="" /></td>
            </tr>
        </table>

        <form action="" method="post" enctype="multipart/form-data" name="involucrados" id="involucrados">
            <table width="755" height="263" border="0" background="../imagenes/fondo.jpg" align="center">
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="3" align="center">&nbsp;</td>
                    <td colspan="2" align="center">&nbsp;</td>
                    <td colspan="2" align="center">&nbsp;</td>
                </tr>
                <tr>
                    <td width="1" align="left">&nbsp;</td>
                    <td width="132" height="35" align="left"><span class="style15">Otorgante</span></td>
                    <?php
                    $R = "SELECT CONCAT(nom_inv,' ',pat_inv,' ', mat_inv) AS otorgante, otros FROM involucrados1 WHERE cod_inv = $cod_otor";
                    $Q = mysql_query($R);
                    $P = mysql_fetch_array($Q);
                    ?>
                    <td colspan="7" align="left"><input name="otor" type="text" id="otor" size="90" value="<?php echo $P[0]; ?>"/></td>
                </tr>
                <tr>
                    <td align="left">&nbsp;</td>
                    <td height="24" align="left">Otros</td>
                    <td colspan="7" align="left"><textarea name="otro1" cols="68" rows="" id="otro1"><?php echo $P[1]; ?>
                        </textarea></td>
                </tr>
                <tr>
                    <td align="left">&nbsp;</td>
                    <?php
                    $D = "SELECT CONCAT(nom_inv,' ',pat_inv,' ', mat_inv) AS otorgante, otros FROM involucrados1 WHERE cod_inv = $cod_fav";
                    $E = mysql_query($D);
                    $F = mysql_fetch_array($E);
                    ?>
                    <td height="24" align="left"><span class="style15" align="left">Favorecido</span></td>
                    <td colspan="7" align="left"><input name="fav" type="text" id="fav" size="90" value="<?php echo $F[0]; ?>"/></td>
                </tr>
                <tr>
                    <td align="left">&nbsp;</td>
                    <td height="30" align="left"><span class="style15">Otros</span></td>
                    <td colspan="7" align="left"><textarea name="otros2" cols="68" rows="" id="otros2"><?php echo $F[1]; ?>
                        </textarea></td>
                </tr>
                <tr>
                    <td align="left">&nbsp;</td>
                    <td height="33" align="left"><span class="style15">Nombre del Bien</span></td>
                    <td colspan="7" align="left"><input name="nbien" type="text" id="nbien" size="70" value="<?php echo $ver["NBien"]; ?>"/></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td height="40"><span class="style15" align="left">Fecha</span></td>
                    <td colspan="5" align="left"><label>
                            <input name="fecha" type="text" id="fecha" value="<?php echo $ver["Fecha"]; ?>"/>
                        </label></td>
                </tr>
                <tr>
                    <td align="left">&nbsp;</td>
                    <td height="29" align="left"><span class="style15">Observaciones</span></td>
                    <td colspan="7" align="left"><textarea name="obs" cols="60" rows="" ><?php echo $ver["Obs"]; ?>
                        </textarea></td>
                </tr>
                <tr>
                    <td class="style15">&nbsp;</td>
                    <td height="26" class="style15">Protocolo</td>
                    <td width="76" class="style15"><label>
                            <input name="pro" type="text" id="pro" size="10" value="<?php echo $ver["Protocolo"]; ?>"/>
                        </label></td>
                    <td width="99" class="style15" align="right">N&ordm; Escritura</td>
                    <td width="69" class="style15"><label>
                            <input name="sct" type="text" id="sct" size="10" value="<?php echo $ver["Escritura"]; ?>"/>
                        </label></td>
                    <td width="69" class="style15" align="right">Folio</td>
                    <td width="93" class="style15"><label>
                            <input name="folio" type="text" id="folio" size="10" value="<?php echo $ver["Folio"]; ?>" />
                        </label></td>
                    <td width="110" class="style15" align="right">Cant.Folio</td>
                    <td width="68" class="style15"><label>
                            <input name="cant_fol" type="text" id="cant_fol" size="10" value="<?php echo $ver["NumFolios"]; ?>"/>
                        </label></td>
                </tr>
                <tr>
                    <td class="style15">&nbsp;</td>
                    <td class="style15">Notario</td>
                    <?php
                    $nr = $ver["Notario"];
                    $nis = "SELECT CONCAT(nom_not,' ', pat_not,' ', mat_not) AS Notario FROM notarios WHERE cod_not = $nr";
                    $nis1 = mysql_query($nis);
                    $nto = mysql_fetch_array($nis1);
                    ?>
                    <td colspan="5" class="style15"><input name="notario" type="text" id="notario" size="70" value="<?php echo $nto[0]; ?>" /></td>
                    <td class="style15" align="right">Distrito</td>
                    <?php
                    $dr = $ver["Distrito"];
                    $dis = "SELECT des_dst FROM distritos WHERE cod_dst = $dr";
                    $dis1 = mysql_query($dis);
                    $dto = mysql_fetch_array($dis1);
                    ?>
                    <td class="style15"><input name="dst" type="text" id="dst" size="10" value="<?php echo $dto[0]; ?>"/></td>
                </tr>
                <tr>
                    <td class="style15">&nbsp;</td>
                    <td class="style15">Sub Serie</td>
                    <?php
                    $Sr = $ver["SubSerie"];
                    $Sis = "SELECT des_sub from subseries WHERE cod_sub = $Sr";
                    $Sis1 = mysql_query($Sis);
                    $Sto = mysql_fetch_array($Sis1);
                    ?>
                    <td colspan="5" class="style15"><input name="sub_serie" type="text" id="sub_serie" size="70" value="<?php echo $Sto[0]; ?>"/></td>
                    <td colspan="2" class="style15">&nbsp;</td>
                </tr>
                <tr>
                    <td></td>
                    <td height="26" class="style15">Trabajador</td>
                    <td colspan="5" align="center"><div align="left">
                            <?php
                            $ur = $ver["Usuario"];
                            $uis = "SELECT CONCAT(nom_usu,' ', pat_usu,' ', mat_usu) as Usuario FROM usuarios WHERE cod_usu = $ur";
                            $uis1 = mysql_query($uis);
                            $uto = mysql_fetch_array($uis1);
                            ?>
                            <input name="textfield2" type="text" size="60" value="<?php echo $uto[0]; ?>" />
                        </div></td>
                </tr>
                <tr>
                    <td></td>
                    <td height="26"></td>
                    <td colspan="3" align="center"><input type="submit" class="boton" name="btnbuscar" id="btnbuscar" value="Buscar" />      </td>
                    <td colspan="2" align="center"><a href="../../Controler/session_close.php">
                            <input name="btnsalir" type="submit" id="btnsalir" value="Refrescar" />
                        </a> </td>
                </tr>
            </table>
        </form>
    </body>
</html>