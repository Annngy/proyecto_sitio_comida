<?php
include_once "../mesero/funciones.php";
if (!isset($_POST["id_usuario"])) {
    exit("No hay id_usuario");
}

include_once "../mesero/funciones.php";
if (!isset($_POST["status"])) {
    exit("No hay status");
}

actualizaStatus($_POST["status"],$_POST["id_usuario"]);
$_SESSION['status_usuario']=$_POST["status"];

header("Location: ../mesero/index.php");
?>
