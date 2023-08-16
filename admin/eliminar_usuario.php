<?php
include_once "../mesero/funciones.php";
if (!isset($_POST["id_usuario"])) {
    exit("No hay id_usuario");
}

eliminarUsuario($_POST["id_usuario"]);

    header("Location: usuario.php");