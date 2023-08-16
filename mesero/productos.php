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
    <title>NOT ONLY FRIENDS</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
</head>

<body>
<?php
include_once "funciones.php";
$IdPedido = obtenerUltimoIdPedido();
?>
<?php foreach ($IdPedido as $idPedido ) { ?>
    <nav class="navbar is-warning" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" >
            <img src="../includes/encabezado.jpg" alt="Tienda de comida rápida" class="img-fluid"> </a>
            <button class="navbar-burger is-warning button" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>
        </div>
        <div class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="index.php">Inicio</a>
                <a class="navbar-item" href="detallePedido.php">Detalles del Pedido</a>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="ver_pedido.php" class="button is-success">
                            <strong>Ver Pedido <?php
                                                include_once "funciones.php";
                                                $conteo = count(obtenerIdsDeProductosEnCarrito($idPedido->id));
                                                if ($conteo > 0) {
                                                    printf("(%d)", $conteo);
                                                }
                                                ?>&nbsp;<i class="fa fa-shopping-cart"></i></strong>
                        </a>
                    </div>
                </div>
                <div class="navbar-item">
                   
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
  

    <section class="section">
    <p class="card-header-title is-size-4">
                                Selecciona los productos del pedido
                            </p>
   
    <div class="container">
                    <form action="" method="POST" class="mb-3">
                     <div class="card">
                     <p class="card-header-title is-size-4">
                     Buscar producto:
                            </p>
                        <div class="input-group">
                        
                            <input  type="text" name="busqueda" class="input" placeholder="Buscar productos">
                            <br>
                            <br>
                            <button type="submit" class="button is-primary">Buscar</button>
                            <br>
                            <br>
                        </div>
                        </div>
                        <p class="card-header-title is-size-4">
                                Menú disponible:
                            </p>
                    </form>
                    <?php
                    include_once "funciones.php";
                    if (isset($_POST['busqueda'])) {
                        $busqueda = $_POST['busqueda'];
                        $productos = buscarProductos($busqueda);
                        
                    } else {
                        $productos = obtenerProductos();
                    }
                    
                    
                    ?>
        <div class="columns is-multiline">
            <?php foreach ($productos as $producto ) { ?>
               
                <div class="column is-one-third">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title is-size-4">
                                <?php echo $producto->Nombre ?>
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <?php echo $producto->Descripcion ?>
                                <br>
                                <br>
                                <?php echo 'Categoria: '.$producto->Categoria ?>
                                <br>
                                <br>
                                <?php echo 'Disponibles: '.$producto->Stock ?>
                            </div>
                            <h1 class="is-size-3">$<?php echo number_format($producto->Precio, 2) ?></h1>    
                                <br>
                                <form action="agregar_al_pedido.php" method="post">
                                    <label >Comentarios:</label>
                                    <input class="input" id="comentarios" <?php echo $producto->NumProducto ?> type="text" name="comentarios" placeholder="Agregar comentarios">
                                    <br> 
                                    <br> 
                                    <input type="hidden" name="id_producto" value="<?php echo $idPedido->id  ?>">
                                    <input type="hidden" name="id_pedido" value="<?php echo $producto->NumProducto  ?>">                                  
                                    <button class="button is-primary">
                                        <i class="fa fa-cart-plus"></i>&nbsp;Agregar al pedido
                                    </button>
                                </form>
                            
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
</section>
</body>


</html>