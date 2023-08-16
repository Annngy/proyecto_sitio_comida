<?php
include_once "../mesero/funciones.php";

if (!isset($_POST["Nombre"])) {
    exit("No hay Nombre");
}
if (!isset($_POST["email"])) {
    exit("No hay email");
}
if (!isset($_POST["id_rol"])) {
    exit("No hay id_rol");
}
if (!isset($_POST["password"])) {
    exit("No hay password");
}
if (!isset($_POST["usuario"])) {
    exit("No hay usuario");
}
if (!isset($_POST["Estado"])) {
    exit("No hay Estado");
}

actualizarUsuario($_POST["Nombre"],$_POST["email"],$_POST["password"],$_POST["id_rol"],$_POST["Estado"],$_POST["usuario"]);


    header("Location: usuario.php");