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
    <title>Detalles de usuarios</title>
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
        <div class="navbar-menu">


            <div class="navbar-menu">
                <div class="navbar-start">

                    <a class="navbar-item" href="index.php">Inicio</a>
                    <a class="navbar-item" href="producto.php">Productos</a>
                    <a class="navbar-item" href="categoria.php">Categorias</a>
                    <a class="navbar-item" href="detalleventa.php">Detalle Venta</a>
                    <a class="navbar-item" href="detallepedidos.php">Detalle Pedidos</a>

                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <a href="../cerrar_sesion.php" class="button is-danger">
                                <strong>Cerrar Sesión</strong>
                            </a>
                        </div>
                    </div>
                    <div class="navbar-item">
                    </div>
                </div>
            </div>

        </div>
        </div>
    </nav>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", () => {
            const boton = document.querySelector(".navbar-burger");
            const menu = document.querySelector(".navbar-menu");
            boton.onclick = () => {
                menu.classList.toggle("is-active");
                boton.classList.toggle("is-active");
            };
        });
    </script>

    <form action="#" method="POST" class="mb-3">
        <div class="card">
            <p class="card-header-title is-size-4 ">
                Buscar Usuario:
            </p>
            <div class="field has-addons">
                <div class="control">
                    <input type="text" name="busqueda" class="input is-small ml-5" placeholder="Buscar usuarios">
                </div>
                <div class="control">
                    <button type="submit" class="button is-primary is-small">Buscar</button>
                </div>
            </div>
            <br>
        </div>
        <p class="card-header-title is-size-4">
            Detalles de usuario
        </p>
            <a href="agrega_usuario.php"class="button is-info ml-5 ">Nuevo Usuario</a>
    </form>
    <?php
    include_once "../mesero/funciones.php";
    $busqueda = '';
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
    }
    $usuarios = buscarusuario($busqueda);
    ?>

    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h2 class="is-size-2"></h2>
            <table class="table">
                <thead>
                    <tr>
        
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($usuarios as $usuario) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $usuario->id_usuario ?>
                            </td>
                            <td>
                                <?php echo $usuario->Nombre_empleado ?>
                            </td>
                            <td>
                                <?php echo $usuario->Email ?>
                            </td>
                            <td>
                                <?php echo $usuario->password ?>
                            </td>
                            <td>
                                <?php echo $usuario->Rol_empleado ?>
                            </td>
                            <td style="<?php echo ($usuario->Estado == 'Activo' || $usuario->Estado == 'activo') ? 'color: green;' : 'color: red;' ?>">
                            <?php echo $usuario->Estado ?>
                            </td>
                           
                            <td>
                                <form action="eliminar_usuario.php" method="post">
                                    <input type="hidden" name="id_usuario" value="<?php echo $usuario->id_usuario ?>">
                                    <button class="button is-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="editar_usuario.php" method="post">
                                    <input type="hidden" name="id_usuario" value="<?php echo $usuario->id_usuario ?>">
                                    <input type="hidden" name="Nombre" value="<?php echo $usuario->Nombre_empleado ?>">
                                    <input type="hidden" name="Email" value="<?php echo $usuario->Email ?>">
                                    <input type="hidden" name="Rol_empleado" value="<?php echo $usuario->Rol_empleado ?>">
                                    <input type="hidden" name="Estado" value="<?php echo $usuario->Estado ?>">
                                    <input type="hidden" name="password" value="<?php echo $usuario->password ?>">
                                    <input type="hidden" name="id_rol" value="<?php echo $usuario->id_rol ?>">
                                    <button class="button is-success">
                                        Editar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>