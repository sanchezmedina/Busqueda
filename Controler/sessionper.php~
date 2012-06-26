<?php

session_start();
require_once '../Model/cone.php';
//*********
$link = new conexionclass();
$link->Conectado();
$user = $_POST['txtusu'];
$pas = $_POST['txtpas'];
//**********
$sql = "SELECT cod_usu, niv_usu FROM usuarios WHERE log_usu='$user' AND psw_usu ='$pas' LIMIT 0,1;";
$result = $link->consulta($sql);
$fila = $link->fetch_array($result);
//*********
$num = $link->num_rows($result);
if ($num > 0) {
    switch ($fila["niv_usu"]) {
        case 1: $_SESSION['admin'] = $fila['cod_usu'];

            header("Location: ../View/Admin/index.php");
            break;
        case 2: $_SESSION['personal'] = $fila['cod_usu'];

           header("Location: ../View/Personal/index.php");
            break;
        case 3: $_SESSION['otro'] = $fila['cod_usu'];

            header("Location: ../View/Admin1/index.php");
            break;
        case 4: $_SESSION['busqueda'] = $fila['cod_usu'];

            header("Location: ../Busqueda/index.php");
            break;
    }
} else {

    header("Location: ../arpweb/index.htm");
}
?>
