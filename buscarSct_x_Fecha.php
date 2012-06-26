<?php
require_once 'Model/conection_search.php';
$link = new ConexionClass();
$link->conectarse();

//Obtener el Numero de Escritura
@$cod_otor = $_REQUEST['cod_otor'];
@$cod_favor = $_REQUEST['cod_favor'];
@$cod_otor_ju = $_REQUEST['cod_otor_ju'];
@$cod_favor_ju = $_REQUEST['cod_favor_ju'];
@$cod_sct = $_REQUEST['cod_sct'];

//echo "Codigo Otorgante".$cod_otor =$_REQUEST['cod_otor'];
//echo "Codigo Favorecido".$cod_favor = $_REQUEST['cod_favor'];
//echo "Codigo Escritura".$cod_sct = $_REQUEST['cod_sct'];

$consult2 = "SELECT cod_not, num_sct, cod_dst, fec_doc, cod_sub, nom_bie, can_fol, cod_pro, obs_sct, num_fol, cod_usu FROM escrituras1 WHERE cod_sct = $cod_sct";
$query2 = mysql_query($consult2);
$dato2 = mysql_fetch_array($query2);
$ver = array("Notario" => $dato2[0], "Escritura" => $dato2[1], "Distrito" => $dato2[2], "Fecha" => $dato2[3], "SubSerie" => $dato2[4], "NBien" => $dato2[5], "NumFolios" => $dato2[6], "Protocolo" => $dato2[7], "Obs" => $dato2[8], "Folio" => $dato2[9], "Usuario" => $dato2[10]);
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
        <meta name="description" content="Escritura Publica">
        <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
        <link rel="stylesheet" href="css/secciones.css" />
        <!-- <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black"> -->
        <!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->
        <!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->
        <meta http-equiv="cleartype" content="on" />
        <script src="js/libs/modernizr-2.5.3.min.js"></script>
        <script src="js/libs/modernizr-2.0.6.min.js"></script>
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

            <header>
                <h2>Detalles de la Busqueda</h2>
            </header>
            <?php
            $ver_otorgante;
            $var1 = $cod_otor;
            $var2 = $cod_otor_ju;
            $q_oto = "SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv), otros FROM involucrados1 as a WHERE a.cod_inv = '$var1'";
            $query1 = mysql_query($q_oto) or die(mysql_error() . " Error Buscado otorgante");
            $r1 = mysql_fetch_array($query1);
            //echo "Sie sta mos aqui".$r1[1];
            $ver_otorgante = $r1[1];
            if ($var2 <> 0) {
                $RESULT = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$var2'";
                $QUERY = mysql_query($RESULT);
                $FILA = mysql_fetch_array($QUERY);
                //echo $FILA[1];
                $ver_otorgante = $FILA[1];
            }
            ?>

            <section id="detalles">
                <p>Otorgante: <?php echo $ver_otorgante; ?><br>
                    Otros: <?php echo $r1[2]; ?>
                </p>

                <p>Favorecido:
                    <?php
                    $ver_favorecido;
                    $var3 = $cod_favor;
                    $var4 = $cod_favor_ju;
                    $q_fav = "SELECT a.Cod_inv, CONCAT(a.Nom_inv,' ',a.Pat_inv,' ',a.Mat_inv), otros FROM involucrados1 as a WHERE a.cod_inv = '$var3'";

                    $query2 = mysql_query($q_fav) or die(mysql_error() . " Error Buscado Favorecido");
                    $r2 = mysql_fetch_array($query2);
                    //echo $r2[1];
                    $ver_favorecido = $r2[1];
                    if ($var4 <> 0) {
                        $RESULT2 = "SELECT Cod_inv, Raz_inv FROM involjuridicas1 WHERE Cod_inv = '$var4'";
                        $QUERY2 = mysql_query($RESULT2);
                        $FILA2 = mysql_fetch_array($QUERY2);
                        //echo $FILA2[1];
                        $ver_favorecido = $FILA2[1];
                    }
                    echo $ver_favorecido;
                    ?>
                    <br/>
                    Otros: <?php echo $r2[2]; ?>
                </p>
                <p>Fecha: <?php echo date("d/M/Y", strtotime($ver["Fecha"])); ?></p>
                <p>Tipo de Escritura: 
                    <?php
                    $Sr = $ver["SubSerie"];
                    $Sis = "SELECT des_sub from subseries WHERE cod_sub = $Sr";
                    $Sis1 = mysql_query($Sis);
                    $Sto = mysql_fetch_array($Sis1);
                    echo $Sto[0];
                    ?>
                </p>
                <p>Nombre del Bien: <?php echo $ver["NBien"]; ?></p>
                <p>Observaciones: <?php echo $ver["Obs"]; ?></p>
                <h3>Datos del Documento</h3>
                <p>Notario:
                    <?php
                    $nr = $ver["Notario"];
                    $nis = "SELECT CONCAT(nom_not,' ', pat_not,' ', mat_not) AS Notario FROM notarios WHERE cod_not = $nr";
                    $nis1 = mysql_query($nis);
                    $nto = mysql_fetch_array($nis1);
                    echo $nto[0];
                    ?>
                </p>
                <p>Protocolo: <?php echo $ver["Protocolo"]; ?></p>
                <p>Numero de Escritura: <?php echo $ver["Escritura"]; ?></p>
                <p>Numero de Folio: <?php echo $ver["Folio"]; ?></p>
                <p>Cantidad de Folios: <?php echo $ver["NumFolios"]; ?></p>
                <h3>Otros Datos</h3>
                <p>Provincia:
                    <?php
                    $dr = $ver["Distrito"];
                    $dis = "SELECT des_dst FROM distritos WHERE cod_dst = $dr";
                    $dis1 = mysql_query($dis);
                    $dto = mysql_fetch_array($dis1);
                    echo $dto[0];
                    ?>
                </p>
                <p>Persona que realiz&oacute; el Ingreso:
                    <?php
                    $ur = $ver["Usuario"];
                    $uis = "SELECT CONCAT(nom_usu,' ', pat_usu,' ', mat_usu) as Usuario FROM usuarios WHERE cod_usu = $ur";
                    $uis1 = mysql_query($uis);
                    $uto = mysql_fetch_array($uis1);
                    echo $uto[0];
                    ?>
                </p>
                <p>
                    <?php echo @$F[2]; ?>
                    <?php echo @$F[3]; ?>    
                    <?php echo @$F[4]; ?>
                    <?php echo @$F[5]; ?>    
                    <?php echo @$F[6]; ?>
                    <?php echo @$F[7]; ?>
                </p>
            </section>           
    </body>
</html>