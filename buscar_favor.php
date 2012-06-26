<?php
require_once 'Model/conection_search.php';
require_once 'Model/buscarclass.php';

$link = new ConexionClass();
$link->conectarse();
$busqueda = new Buscar();
/* Consulta de Datos en  la clase buscarclass */
@$nombres = $_REQUEST['nombres'];
@$paterno = $_REQUEST['paterno'];
@$materno = $_REQUEST['materno'];

//inicializo el criterio y recibo cualquier cadena que se desee buscar

if (!empty($nombres)) {
    if (!empty($paterno)) {
        if (!empty($materno)) {
            //echo "sql (nombre, paterno, materno)";
            $query = $busqueda->buscarsql($nombres, $paterno, $materno);
        } else {
            //echo "sql (nombre, paterno)";
            $query = $busqueda->buscarsql($nombres, $paterno, null);
        }
    } else {
        if (!empty($materno)) {
            //echo "sql (nombre, materno)";
            $query = $busqueda->buscarsql($nombres, null, $materno);
        } else {
            //echo "sql (nombre)";
            $query = $busqueda->buscarsql($nombres, null, null);
        }
    }
    //SI  ESYA VACIO				
} else {
    if (!empty($paterno)) {
        if (!empty($materno)) {
            //echo "SQL (PATERNO, MATERNO)";
            $query = $busqueda->buscarsql(null, $paterno, $materno);
        } else {
            //echo "SQL (PATERNO)";
            $query = $busqueda->buscarsql(null, $paterno, null);
        }
    } else {
        if (!empty($materno)) {
            //echo "SQL (MATERNO)";
            $query = $busqueda->buscarsql(null, null, $materno);
        } else {
            /* echo "Error, No ha ingresado ningun Nombre o Apellido"; */
        }
    }
}

@$res = mysql_query($query);
$numeroRegistros = @mysql_num_rows($res);
if ($numeroRegistros <= 0) {
    /* echo "<div align='center'>";
      echo "No se encontraron resultados";
      echo "</div>"; */
} else {
    //////////elementos para el orden
    //////////fin elementos de orden
    //////////calculo de elementos necesarios para paginacion
    //////////tama�o de la pagina
    $tamPag = 20;
    //pagina actual si no esta definida y limites
    if (!isset($_GET["pagina"])) {
        $pagina = 1;
        $inicio = 1;
        $final = $tamPag;
    } else {
        $pagina = $_GET["pagina"];
    }
    //calculo del limite inferior
    $limitInf = ($pagina - 1) * $tamPag;

    //calculo del numero de paginas
    $numPags = ceil($numeroRegistros / $tamPag);
    if (!isset($pagina)) {
        $pagina = 1;
        $inicio = 1;
        $final = $tamPag;
    } else {
        $seccionActual = intval(($pagina - 1) / $tamPag);
        $inicio = ($seccionActual * $tamPag) + 1;

        if ($pagina < $numPags) {
            $final = $inicio + $tamPag - 1;
        } else {
            $final = $numPags;
        }

        if ($final > $numPags) {
            $final = $numPags;
        }
    }

//////////fin de dicho calculo
//////////creacion de la consulta con limites
    $sql = $query . " LIMIT " . $limitInf . "," . $tamPag;
    $res = mysql_query($sql);

//////////fin consulta con limites
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
            function muestra(codigo, nombre){
                location.href="buscar_favor_detail.php?cod_favor1="+ codigo +"&nombre_favor="+ nombre +"";
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


            <section id="formularios">
                <form name="form_busqueda" method="get">
                    <h2>Busca por el Favorecido (Comprador)</h2>

                    <label for="nombres">Nombre(s):</label>
                    <input type="text" name="nombres" id="nombres" placeholder="Nombre" value="<?php echo $nombres; ?>" />
                    <label for="paterno">Apellido Paterno</label>
                    <input type="text" name="paterno" name="paterno" placeholder="Apellido Paterno" value="<?php echo $paterno; ?>" />
                    <label for="materno">Apellido Materno</label>
                    <input type="text" name="materno" id="materno" placeholder="Apellido Materno" value="<?php echo $materno; ?>"/> 
                    <button type="submit">Buscar</button>
                </form>
            </section>
            <!-- Muesta de Resultados de la Base de Datos con Tablas -->
            <section id="resultados">
                <table>
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>Nombres</th>
                            <th>opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($registro = @mysql_fetch_array($res)) {
                            ?>
                            <tr onClick="javascript:muestra('<?php echo $registro["Cod_inv"]; ?>','<?php echo $registro["Nom_inv"] . " " . $registro["Pat_inv"] . " " . $registro["Mat_inv"]; ?>');">
                                <td><input type="hidden" name="cod_otor" id="cod_otor" value="<?php echo $registro["Cod_inv"]; ?>" /></td>
                                <td><?php echo $registro["Nom_inv"] . " " . $registro["Pat_inv"] . " " . $registro["Mat_inv"]; ?></td>
                                <td>Ver</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <?php
                                if (@$pagina > 1) {
                                    echo "<a class='' href='" . $_SERVER["PHP_SELF"] . "?pagina=" . ($pagina - 1) . "&orden=" . $orden . "&nombres=" . $nombres . "'>";
                                    echo "Anterior";
                                    echo "</a> ";
                                }

                                for (@$i = @$inicio; @$i <= @$final; @$i++) {
                                    if (@$i == @$pagina) {
                                        echo "<b>" . $i . "</b>";
                                    } else {
                                        echo "<a class='' href='" . $_SERVER["PHP_SELF"] . "?pagina=" . $i . "&orden=" . $orden . "&nombres=" . $nombres . "&paterno=" . $paterno . "&materno=" . $materno . "'>";
                                        echo $i . "</a> ";
                                    }
                                }
                                if (@$pagina < @$numPags) {
                                    echo "<a class='' href='" . $_SERVER["PHP_SELF"] . "?pagina=" . ($pagina + 1) . "&orden=" . $orden . "&nombres=" . $nombres . "'>";
                                    echo "Siguiente</a>";
                                }
//////////fin de la paginacion
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </section>

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