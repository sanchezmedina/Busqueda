<?php
require_once 'Model/conection_search.php';
$link = new ConexionClass();
$link->conectarse();

$cod_otor = $_REQUEST['cod_otor'];
$nombre = $_REQUEST['nombre'];
//  Datos del Favorecido
$query = "SELECT cod_sct FROM escriotor1 WHERE cod_inv = $cod_otor";
$result1 = $link->consulta($query);

if ($link->num_rows($result1) > 0) {
    ?>

    <!DOCTYPE HTML> 
    <!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->
    <!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->
    <!--[if IE 8]>    <html class="no-js lt-ie9" lang="es"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js" lang="es">
        <!--<![endif]-->
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
            <meta name="HandheldFriendly" content="True">
            <meta name="MobileOptimized" content="320">
            <title>Busca tu Escritura Publica - Archivo Regional de Puno</title>
            <meta name="description" content="Escritura Publica">
            <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
            <link rel="stylesheet" href="css/secciones.css">
            <!-- <meta name="apple-mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->
            <!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->
            <!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->
            <meta http-equiv="cleartype" content="on">
            <script src="js/libs/modernizr-2.5.3.min.js"></script>
            <script src="js/libs/modernizr-2.0.6.min.js"></script>
            <script language="javascript" type="text/javascript">
                function muestra(cod_otor, cod_sct, cod_fav, cod_fav_ju){
                    location.href="buscarSct_x_Fecha.php?cod_otor="+cod_otor+"&cod_sct="+cod_sct+"&cod_favor="+cod_fav+"&cod_favor_ju="+cod_fav_ju+"";
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
                <?php echo "Existe(n): " . $link->num_rows($result1) . " Favorecidos"; ?>  
                <table>
                    <caption>Otorgante: <?php echo $nombre; ?> </caption>
                    <thead>
                        <tr>
                            <th width="20">Num</th>
                            <th width="260">Favorecido</th>
                            <th width="70">Fecha</th>
                            <th>SubSerie</th>
                            <th>Nombre del Bien </th>
                            <th>Protocolo</th>
                            <th>Escritura</th>
                            <th>Folio</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    while (@$fila2 = mysql_fetch_array($result1)) {
                        $sct1 = array("escritura" => $fila2[0]);
                        $Escritura = $sct1["escritura"];
                        $con_14 = "SELECT cod_sct, cod_inv, cod_inv_ju FROM escrifavor1 WHERE cod_sct = '$Escritura'";
                        $q14 = mysql_query($con_14);
                        $a14 = mysql_fetch_array($q14);
                        $array_f = array("cod_sct" => $a14[0], "cod_inv" => $a14[1], "codInvJur" => $a14[2]);
                        $var0 = $array_f["cod_sct"];
                        $var1 = $array_f["cod_inv"];
                        $var2 = $array_f["codInvJur"];

                        $consulta123 = "SELECT cod_sct, cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol FROM escrituras1 WHERE cod_sct = '$a14[0]' LIMIT 0,250;";
                        $result = mysql_query($consulta123);
                        $fila = mysql_fetch_array($result);
                        $datosEscritura = array("cod_sct" => $fila[0], "notario" => $fila[1], "escritura" => $fila[2], "distrito" => $fila[3], "fecha" => $fila[4], "subserie" => $fila[5], "bien" => $fila[6], "cantFolios" => $fila[7], "protocolo" => $fila[8], "obs" => $fila[9], "numFolios" => $fila[10]);
                        $Escritura = $datosEscritura["cod_sct"];
                        ?>
                        <tbody>
                            <tr bgcolor="#F0ECCE" onMouseOver="this.style.backgroundColor='#4499CC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#F0ECCE';" onClick="javascript:muestra('<?php echo $cod_otor; ?>','<?php echo $sct1["escritura"]; ?>','<?php echo $var1; ?>','<?php echo $var2; ?>');">
                                <td><?php echo $i; ?></td>
                                <td><b>
                                        <?php
                                        $con_2 = "SELECT cod_sct,cod_inv,cod_inv_ju FROM escrifavor1 WHERE cod_sct ='$Escritura'";
                                        $q2 = mysql_query($con_2);
                                        $a2 = mysql_fetch_array($q2);
                                        $array_f = array("cod_sct" => $a2[0], "cod_inv" => $a2[1], "codInvJur" => $a2[2]);
                                        $var3 = $array_f["cod_inv"];
                                        $var4 = $array_f["codInvJur"];
                                        $q_fav = "SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv), b.Cod_inv, b.Raz_inv FROM involucrados1 as a, involjuridicas1 as b WHERE a.cod_inv = '$var1'";

                                        $query2 = mysql_query($q_fav) or die(mysql_error() . " Error Buscado Favorecido");
                                        $r2 = mysql_fetch_array($query2);
                                        echo $r2[1];
                                        if ($var4 <> 0) {
                                            $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$var2'";
                                            $QUERY2 = mysql_query($RESULT2);
                                            $FILA2 = mysql_fetch_array($QUERY2);
                                            echo $FILA2[1];
                                        }
                                        ?>	
                                    </b></td>
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
                                <td><?php echo $datosEscritura["numFolios"]; ?></td>
                            </tr>
                            <?php
                            $i = $i + 1;
                        }
                        ?>
                    </tbody>
                </table>

                <?php
            } else {
                header("Location: 405.html");
            }
            ?>
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