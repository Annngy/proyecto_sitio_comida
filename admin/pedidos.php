<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pedidos</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        .producto {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<header>
        <!-- Encabezado de la página -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Not Only Friends</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="producto.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="usuario.php">Usuario</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="detalleventa.php">Detalle Venta</a>
                        </li>
                    </ul>
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
                <div class="col-lg-12">
                   <br >
                    <form action="" method="POST" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="busqueda" class="form-control" placeholder="Buscar pedido">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <h2>Pedidos</h2>
                <?php
                header('Content-Type: text/html; charset=utf-8');

                // Conexión a la base de datos
                $host = "localhost";
                $usuario = "root";
                $contrasena = "ars1709cyj";
                $base_de_datos = "proyectoManuel";

                $conexion = mysqli_connect($host, $usuario, $contrasena, $base_de_datos);

                if (!$conexion) {
                    die("Error al conectar a la base de datos: " . mysqli_connect_error());
                }

                // Obtener el valor de búsqueda del formulario
                if (isset($_POST['busqueda'])) {
                    $busqueda = $_POST['busqueda'];
                } else {
                    $busqueda = "";
                }

                // Llamada al procedimiento almacenado con el parámetro de búsqueda
                mysqli_query($conexion, "SET NAMES 'utf8'");
                $query = "CALL ConsultaPedidoYbusqueda('$busqueda')";
                $resultado = mysqli_query($conexion, $query);

                if ($resultado) {
                    if (mysqli_num_rows($resultado) > 0) {
                        echo "<table class='table'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Número de Pedido</th>";
                        echo "<th>Nombre Mesero</th>";
                        echo "<th>Fecha</th>";
                        echo "<th>Estatus</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
            
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $fila['Numero Pedido'] . "</td>";
                            echo "<td>" . $fila['Nombre mesero'] . "</td>";
                            echo "<td>" . $fila['Fecha'] . "</td>";
                            echo "<td>" . $fila['Estado'] . "</td>";
                            echo "</tr>";
                        }
            
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "No se encontraron detalles de pedidos.";
                    }
                } else {
                    echo "Error al consultar los detalles de pedidos: " . mysqli_error($conexion);
                }
    
                mysqli_close($conexion);
            ?>
            </div>
        </div>

    <footer>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>    
</body>
</html>
