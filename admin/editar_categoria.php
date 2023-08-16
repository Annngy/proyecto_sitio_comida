<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header('location: ../index.php');
} else {
    if ($_SESSION['rol'] != 1) {
        header('location: ../index.php');
    }
}

$rol = $_SESSION['rol'];
$Id = $_SESSION['id'];
$Us = $_SESSION['nombre'];
$email = $_SESSION['correo'];
$Psw = $_SESSION['password'];
$status = $_SESSION['status_usuario'];


?>

<!DOCTYPE html>
<html lang="es">
<?php
if (!isset($_POST["id"])) {
    exit("No hay id");
}
if (!isset($_POST["Nombre"])) {
    exit("No hay Nombre");
}
 ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
</head>
 <body>
    <nav class="navbar is-warning" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item">
                <img src="../includes/encabezado.jpg" alt="Tienda de comida rápida" class="img-fluid"> </a>
            <button class="navbar-burger is-warning button" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
        </div>
    </nav>
    <section class="section">
        <div class="container">
            <h1 class="title">Editar categoria</h1>
            <form action="actualiza_categoria.php" method="POST">
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">ID</label>
                            <div class="control">
                                <input class="input" disabled value="<?php echo $_POST["id"]?>" type="text" name="ID" >
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Nombre</label>
                            <div class="control">
                                <input class="input"  value="<?php echo $_POST["Nombre"]?>" type="text" name="Nombre" required>
                            </div>
                        </div>


                    </div>
                </div>
                <input type="hidden" name="id_cat" value="<?php echo $_POST["id"]?>">
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link"><i class="fa fa-save"></i> Guardar</button>
                    </div>
             </form>
             <div class="control">
            <a href="categoria.php" class="button is-link is-light "><i class="fa fa-close"></i> Cancelar</a>
                    </div>
                 </div>
        </div>
    </section>
</body>
 </html>