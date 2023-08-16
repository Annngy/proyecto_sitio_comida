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
    <title>Detalles del Producto</title>
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
                    <a class="navbar-item" href="usuario.php">Usuarios</a>
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
                Buscar Producto:
            </p>
            <div class="field has-addons">
                <div class="control">
                    <input type="text" name="busqueda" class="input is-small ml-5" placeholder="Buscar pedidos">
                </div>
                <div class="control">
                    <button type="submit" class="button is-primary is-small">Buscar</button>
                </div>
            </div>
            <br>
        </div>
        <p class="card-header-title is-size-4">
            Detalles de producto
        </p>
            <a href="agregar_producto.php"class="button is-info ml-5 ">Nuevo Producto</a>
    </form>
    <?php
    include_once "../mesero/funciones.php";
    $busqueda = '';
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
    }
    $productos = ConsultaProductoPorNombre($busqueda);
    ?>

    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h2 class="is-size-2"></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nombre Producto</th>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($productos as $producto) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $producto->NumProducto ?>
                            </td>
                            <td>
                                <?php echo $producto->Nombre ?>
                            </td>
                            <td>
                                <?php echo $producto->Categoria ?>
                            </td>
                            <td>
                                <?php echo $producto->Descripcion ?>
                            </td>
                            <td>
                                <?php echo $producto->Precio ?>
                            </td>
                            <td>
                                <?php echo $producto->Stock ?>
                            </td>
                            <td>
                                <form action="eliminar_producto.php" method="post">
                                    <input type="hidden" name="id_producto" value="<?php echo $producto->NumProducto ?>">
                                    <button class="button is-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="editar_producto.php" method="post">
                                    <input type="hidden" name="SKU" value="<?php echo $producto->NumProducto ?>">
                                    <input type="hidden" name="Nombre" value="<?php echo $producto->Nombre ?>">
                                    <input type="hidden" name="Categoria" value="<?php echo $producto->Categoria ?>">
                                    <input type="hidden" name="Descripcion" value="<?php echo $producto->Descripcion ?>">
                                    <input type="hidden" name="Precio" value="<?php echo $producto->Precio ?>">
                                    <input type="hidden" name="Stock" value="<?php echo $producto->Stock ?>">
                                    <input type="hidden" name="idcategoria" value="<?php echo $producto->idcategoria ?>">
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