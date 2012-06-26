<?php
require_once 'Model/conection_search.php';
$link = new ConexionClass();
$link->conectarse();

@$dia = $_REQUEST['dia'];
@$mes = $_REQUEST['mes'];
@$year = $_REQUEST['year'];

if ($dia <> "" and $mes <> "" and $year <> "") {
    $fecha = $year . "-" . $mes . "-" . $dia;
    $consulta = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras1 WHERE fec_doc ='$fecha' ORDER BY fec_doc;";
    $result = $link->consulta($consulta);
    $total = $link->num_rows($result);
}

if ($dia == "") {
    $fecha = $year . "-" . $mes . "-" . "%";
    $consulta = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM dbarp.escrituras1 WHERE fec_doc LIKE '$fecha' ORDER BY fec_doc;";
    $result = $link->consulta($consulta);
    $total = $link->num_rows($result);
}

if ($dia == "" and $mes == 0) {
    $fecha = $year . "-" . "%" . "-" . "%";
    $consulta = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM dbarp.escrituras1 WHERE fec_doc LIKE '$fecha' ORDER BY fec_doc LIMIT 0, 700;";
    $result = $link->consulta($consulta);
    $total = $link->num_rows($result);
    $mensaje = "Solo se Muestra 700 Registros, ordenados por fecha";
}
?>

<!DOCTYPE HTML> 
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="es"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="es">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="HandheldFriendly" content="True" />
        <meta name="MobileOptimized" content="320" />
        <title>Busca tu Escritura Publica - Archivo Regional de Puno</title>
        <meta name="description" content="Escritura Publica" />
        <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
        <link rel="stylesheet" href="css/secciones.css" />
        <!-- <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->
        <!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->
        <!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->
        <meta http-equiv="cleartype" content="on" />
        <script src="js/libs/modernizr-2.5.3.min.js"></script>
        <script src="js/libs/modernizr-2.0.6.min.js"></script>
        <script language="javascript" type="text/javascript">
            function muestra(cod_otor,cod_favor,cod_otor_ju,cod_favor_ju,cod_sct){
                location.href="./buscarSct_x_Fecha.php?cod_otor="+cod_otor+"&cod_otor_ju="+cod_otor_ju+"&cod_favor="+cod_favor+"&cod_favor_ju="+cod_favor_ju+"&cod_sct="+cod_sct+"";
            }
        </script>
    </head>

    <body>
      <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
        <section id="contenedor">
            <section id="left">
                <img src="./img/logo_arp.png" alt="Logo Archivo" />
                <a href="../Controler/session_close.php">Salir de Busquedas</a> |
                <a href="javascript:history.back(-1)">Volver Atrás</a> |
                <label>Buscar</label>
                <input type="search" name="buscardor" />
            </section>
            <nav class="black">
                <ul>
                    <li>
                        <a href="#">Inicio</a>
                    </li>
                    <li>
                        <a href="index_search.html">Buscar Escritura</a>
                    </li>
                    <li>
                        <a href="SystemOld/index_old.php">Notarios de Puno, Lampa, Azangaro</a>
                    </li>
                    <li>
                        <a href="#">Buscar por Fecha</a>
                    </li>
                </ul>
            </nav>

            <form id="form1" name="form1" method="post" action="">
                <table>
                    <?php echo "Se han encontrado :" . $total . " escrituras. " . $mensaje . " ----------------------- Fecha:" . date("d/M/Y", strtotime($fecha)); ?>
                    <thead>
                        <tr>
                            <th>Dia</th>
                            <th>Mes</th>
                            <th>A&ntilde;o</th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tr>
                        <td><input name="dia" type="text" id="dia" size="2" maxlength="2" /></td>
                        <td><select name="mes" id="mes">
                                <option value="0">--</option>
                                <option value="01">Ene</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Abr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Ago</option>
                                <option value="09">Set</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dic</option>
                            </select></td>
                        <td><input name="year" type="text" id="year" size="4" maxlength="4" /></td>
                        <td><input name="buscar" type="submit" id="buscar" value="Buscar" /></td>
                    </tr>
                </table>
            </form>
            <table border="1">
                <tr>
                    <td>Num</td>
                    <td>Otorgante</td>
                    <td>Favorecido</td>
                    <td>Tipo Doc</td>
                    <td>Bien</td>
                    <td>Notario</td>
                    <td>Fecha</td>
                    <td>&nbsp;</td>
                </tr>

                <?php
                $i = 1;

                while (@$fila = $link->fetch_array($result)) {
                    $datosEscritura = array("cod_sct" => $fila[0], "notario" => $fila[1], "escritura" => $fila[2], "distrito" => $fila[3], "fecha" => $fila[4], "subserie" => $fila[5], "bien" => $fila[6], "cantFolios" => $fila[7], "protocolo" => $fila[8], "obs" => $fila[9], "numFolios" => $fila[10]);
                    $Escritura = $datosEscritura["cod_sct"];

                    ////****************************  BUSCAR EN OTORGANTES  *********************///
                    $sqlInvolucrado = "SELECT cod_sct,cod_inv,cod_inv_ju FROM escriotor1 WHERE cod_sct = '$Escritura'";
                    $codigos1 = $link->fetch_array($link->consulta($sqlInvolucrado));

                    $Codigo_Involucrado1 = $codigos1["cod_inv"];
                    $Codigo_Involucrado_Juridico1 = $codigos1["cod_inv_ju"];

                    $sqlNombres = "SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv) AS involucrado,b.Cod_inv, b.Raz_inv FROM involucrados1 as a, involjuridicas1 as b WHERE a.cod_inv =$Codigo_Involucrado1";
                    $nombreInvolucrado = $link->fetch_array($link->consulta($sqlNombres));


                    if ($Codigo_Involucrado_Juridico1 <> 0) {
                        $sqlJuridico = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$Codigo_Involucrado_Juridico1'";
                        $nombreInvolucradoJuridico = $link->fetch_array($link->consulta($sqlJuridico));
                        //echo $nombreInvolucradoJuridico["Raz_inv"];
                    }

                    ////****************************  BUSCAR EN FAVORECIDOS  *********************///
                    $sqlInvolucrado2 = "SELECT cod_sct, cod_inv, cod_inv_ju FROM escrifavor1 WHERE cod_sct ='$Escritura'";
                    $codigos2 = $link->fetch_array($link->consulta($sqlInvolucrado2));

                    $Codigo_Involucrado2 = $codigos2["cod_inv"];
                    $Codigo_Involucrado_Juridico2 = $codigos2["cod_inv_ju"];

                    $sqlNombres2 = "SELECT a.Cod_inv, CONCAT(a.Nom_inv, ' ', a.Pat_inv, ' ', a.Mat_inv)AS involucrado, b.Cod_inv, b.Raz_inv FROM involucrados1 as a, involjuridicas1 as b WHERE a.cod_inv = '$Codigo_Involucrado2'";
                    $nombreInvolucrado2 = $link->fetch_array($link->consulta($sqlNombres2));


                    if ($Codigo_Involucrado_Juridico2 <> 0) {
                        $sqlJuridico2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$Codigo_Involucrado_Juridico2'";
                        $nombreInvolucradoJuridico2 = $link->fetch_array($link->consulta($sqlJuridico));
                        //echo $nombreInvolucradoJuridico2["Raz_inv"];
                    }
                    ?>

                    <tr bgcolor="#F0ECCE" onMouseOver="this.style.backgroundColor='#4499CC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#F0ECCE';" onClick="javascript:muestra(<?php echo $Codigo_Involucrado1; ?>,<?php echo $Codigo_Involucrado2; ?>,<?php echo $Codigo_Involucrado_Juridico1; ?>,<?php echo $Codigo_Involucrado_Juridico2; ?>,<?php echo $Escritura; ?>);">
                        <td><?php echo $i; ?></td>
                        <td><?php
                echo $nombreInvolucrado["involucrado"];
                if ($Codigo_Involucrado_Juridico1 <> 0) {
                    echo $nombreInvolucradoJuridico["Raz_inv"];
                }
                ?></td>
                        <td><?php
                echo $nombreInvolucrado2["involucrado"];
                if ($Codigo_Involucrado_Juridico2 <> 0) {
                    echo $nombreInvolucradoJuridico2["Raz_inv"];
                }
                    ?></td>
                        <td>
                            <?php
                            $sqlserie = "SELECT des_sub FROM subseries WHERE cod_sub = '" . $datosEscritura["subserie"] . "'";
                            $nombreSerie = $link->fetch_array($link->consulta($sqlserie));
                            echo $nombreSerie["des_sub"];
                            ?></td>
                        <td><?php echo $datosEscritura["bien"]; ?></td>
                        <td>
                            <?php
                            $sql_notario = "SELECT CONCAT(nom_not, ' ', pat_not, ' ', mat_not) as Notario FROM notarios WHERE cod_not=" . $datosEscritura["notario"];
                            $notario = $link->fetch_array($link->consulta("$sql_notario"));
                            echo $notario["Notario"];
                            ?>
                        </td>
                        <td><?php echo date("d/M/Y", strtotime($datosEscritura["fecha"])); ?></td>

                        <td><a href="./buscarSct_x_Fecha.php?cod_otor=<?php echo $Codigo_Involucrado1; ?>&cod_favor=<?php echo $Codigo_Involucrado2; ?>&cod_otor_ju=<?php echo $Codigo_Involucrado_Juridico1; ?>&cod_favor_ju=<?php echo $Codigo_Involucrado_Juridico2; ?>&cod_sct=<?php echo $Escritura; ?>">Detalles</a></td>
                    </tr>
    <?php
    $i = $i + 1;
}
?>
            </table>

            <footer>
                <p>
                    Copyrigth 2012- Archivio Regional de Puno <br>
                    Direcci&oacute;n: Jr. Arequipa 1145 - Cercado <br>
                    Tel&eacute;fono: (051) 365910 -  363748 <br>
                    email: archivoregionalpuno@arp.org.pe
                    Responsable del &Aacute;rea: Ing. Edgar Apaza - apaza@arp.org.pe<br>
                    edgarapazac@gmail.com  - Tel&eacute;fono:  987 841322
                </p>
            </footer>
        </section>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/script.js"></script>
        <script>
            var _gaq = [['_setAccount', 'UA-XXXXX-X'], ['_trackPageview']]; ( function(d, t) {
                var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g, s)
            }(document, 'script'));

        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
        <!-- scripts concatenated and minified via ant build script -->
        <script src="js/helper.js"></script>
        <!-- end concatenated and minified scripts-->
        <!-- <script src="https://getfirebug.com/firebug-lite.js"></script> -->
        <script>
            // Change UA-XXXXX-X to be your site's ID
            var _gaq = [["_setAccount", "UA-XXXXX-X"], ["_trackPageview"]]; ( function(d, t) {
                var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
                g.async = 1;
                g.src = ("https:" == location.protocol ? "//ssl" : "//www") + ".google-analytics.com/ga.js";
                s.parentNode.insertBefore(g, s)
            }(document, "script"));

        </script>
    </body>
</html>