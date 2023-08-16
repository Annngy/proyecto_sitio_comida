<?php
include_once "../mesero/funciones.php";

if (!isset($_POST["Nombre"])) {
    exit("No hay Nombre");
}

insertarCategoria($_POST["Nombre"]);
header("Location: categoria.php");