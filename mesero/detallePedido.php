<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header('location: ../index.php');
} else {
    if ($_SESSION['rol'] != 2) {
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
    <title>Detalles del pedido</title>
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
            <p class="card-header-title is-size-4">
                Buscar pedido:
            </p>
            <div class="field has-addons">
                <div class="control">
                    <input type="text" name="busqueda" class="input is-small" placeholder="Buscar pedidos">
                </div>
                <div class="control">
                    <button type="submit" class="button is-primary is-small">Buscar</button>
                </div>
            </div>
        </div>
        <p class="card-header-title is-size-4">
            Detalles de pedido
        </p>
    </form>
    <?php
    include_once "funciones.php";
    $busqueda = '';
    if (isset($_POST['busqueda'])) {
        $busqueda = $_POST['busqueda'];
    }
    $productos = consultaDetallePedidoBuscar($busqueda);
    ?>

    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <h2 class="is-size-2"></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Numero Pedido</th>
                        <th>Nombre mesero</th>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Comentarios</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($productos as $producto) {
                        $total +=( $producto->Precio * $producto->Cantidad );
                        ?>
                        <tr>
                            <td><?php echo $producto->Numero_Pedido ?></td>
                            <td><?php echo $producto->Nombre_mesero ?></td>
                            <td><?php echo $producto->Fecha ?></td>
                            <td><?php echo $producto->Producto ?></td>
                            <td><?php echo $producto->Cantidad ?></td>
                            <td><?php echo $producto->Comentarios ?></td>
                            <td>$<?php echo number_format($producto->Precio, 2) ?></td>
                            <td><?php echo $producto->Estado ?></td>

                            <?php if ($producto->Estado == 'Cancelado'): ?>

                                <td>
                                    <form action="eliminar_pedido.php" method="post">
                                        <input type="hidden" name="id_pedido" value="<?php echo $producto->Numero_Pedido ?>">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto ?>">
                                        <button class="button is-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>

                            <?php else: ?>

                                <td>
                                    <form action="eliminar_pedido.php" method="post">
                                        <input type="hidden" name="id_pedido" value="<?php echo $producto->Numero_Pedido ?>">
                                        <input type="hidden" name="id_producto" value="<?php echo $producto->id_producto ?>">
                                        <button class="button is-danger">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="Cambia_status_pedido.php" method="post">
                                        <input type="hidden" name="status" value="<?php echo $statusPedido = 3 ?>">
                                        <input type="hidden" name="id_pedido" value="<?php echo $producto->Numero_Pedido ?>">
                                        <button class="button is-danger">
                                            Cancelar
                                        </button>
                                    </form>
                                </td>

                            <?php endif; ?>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="is-size-4 has-text-right"><strong>Total</strong></td>
                        <td colspan="2" class="is-size-4">
                            $<?php echo number_format($total, 2) ?>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>

</html>
