<?php
include_once "../mesero/funciones.php";

if (!isset($_POST["Nombre"])) {
    exit("No hay Nombre");
}
if (!isset($_POST["email"])) {
    exit("No hay email");
}
if (!isset($_POST["Rol"])) {
    exit("No hay id_rol");
}
if (!isset($_POST["password"])) {
    exit("No hay password");
}
if (!isset($_POST["Estado"])) {
    exit("No hay Estado");
}
echo $_POST["Estado"];
insertarUsuario($_POST["Nombre"],$_POST["email"],$_POST["password"],$_POST["Rol"],$_POST["Estado"]);
header("Location: usuario.php");