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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo usuario</title>
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
            <h1 class="title">Agregar Usuario</h1>
            <form action="inserta_usuario.php" method="POST">
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Nombre</label>
                            <div class="control">
                                <input class="input" value="" type="text" name="Nombre" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label"><i class="fa fa-info-circle"></i> Email</label>
                            <div class="control">
                                <input type="email" name="email" placeholder="Correo electrónico" value="" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Rol</label>
                            <div class="control">
                                <div class="select">
                                    <select name="Rol" required>
                                        <option value="">Selecciona rol</option>
                                        <option value="1">administrador</option>
                                        <option value="2">mesero</option>
                                        <option value="3">chef</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">



                        <div class="field">
                            <label class="label">Estado</label>
                            <div class="control">
                                <div class="select">
                                    <select name="Estado" required>
                                        <option value="">Selecciona estado</option>
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Contraseña</label>
                            <div class="control">
                                <input class="input" value="" type="text" name="password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                    <div class="control">
                        <a href="usuario.php" class="button is-link is-light"><i class="fa fa-close"></i> Cancelar</a>
                    </div>
                </div>
        </div>
    </section>
</body>

</html>