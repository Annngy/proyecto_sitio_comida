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
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin NOT ONLY FRIENDS</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
        <!-- Encabezado de la página -->
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
                <div class="navbar-start">

                    <a class="navbar-item" href="producto.php">Productos</a>

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
        </nav>
        <div class="col-md-12">
            <img src="../includes/encabezado.jpg" alt="Tienda de comida rápida" class="img-fluid">
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
            
                <div class="col-md-6">
                    <h2>Bienvenido a nuestra tienda de comida rápida</h2>
                    <p>Ofrecemos una amplia selección de deliciosos alimentos para satisfacer tus antojos. Nuestro
                        objetivo es proporcionarte los mejores productos de calidad y un excelente servicio al cliente.
                    </p>
                    <p>¡Estamos listos para atenderte!</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- Pie de página -->
        <div class="container">
            <p>Ubicacion: Jilotepec, Centro a un costado del Jardin Central</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>