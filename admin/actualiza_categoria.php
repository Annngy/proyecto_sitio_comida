<?php
include_once "../mesero/funciones.php";

if (!isset($_POST["Nombre"])) {
    exit("No hay Nombre");
}
if (!isset($_POST["id_cat"])) {
    exit("No hay id_cat");
}

actualizarcategoria($_POST["Nombre"],$_POST["id_cat"]);


    header("Location: categoria.php");