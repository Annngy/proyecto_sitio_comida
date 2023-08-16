<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ventas</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        .producto {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function consultarVentasPorNumDeVenta() {
            // Obtener el valor de búsqueda del formulario
            var busqueda = document.getElementById('busqueda').value;

            // Ocultar la tabla de ConsultaTodasLasVentasUnSoloTotal
            var tablaTodasLasVentas = document.getElementById('tablaTodasLasVentas');
            tablaTodasLasVentas.style.display = 'none';

            // Mostrar la tabla de ConsultaVentasPorNumDeVentaUnSoloTotal
            var tablaVentasPorNumVenta = document.getElementById('tablaVentasPorNumVenta');
            tablaVentasPorNumVenta.style.display = 'block';

            // Hacer la petición AJAX para obtener los datos de la tabla ConsultaVentasPorNumDeVentaUnSoloTotal
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'consulta_ventas_por_num_venta.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    tablaVentasPorNumVenta.innerHTML = xhr.responseText;
                }
            };
            xhr.send('busqueda=' + busqueda);
        }
    </script>
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
                            <a class="nav-link" href="ventas.php">Ventas</a>
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
                    <br>
                    <form action="#" method="POST" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="busqueda" id="busqueda" class="form-control" placeholder="Buscar pedido">
                            <button type="button" onclick="consultarVentasPorNumDeVenta()" class="btn btn-primary">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <h2>Ventas</h2>
                <div id="tablaTodasLasVentas">
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

                    // Llamada al procedimiento almacenado ConsultaTodasLasVentasUnSoloTotal
                    mysqli_query($conexion, "SET NAMES 'utf8'");
                    $query = "CALL ConsultaTodasLasVentasUnSoloTotal()";
                    $resultado = mysqli_query($conexion, $query);

                    if ($resultado) {
                        if (mysqli_num_rows($resultado) > 0) {
                            echo "<table class='table'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Número Venta</th>";
                            echo "<th>Nombre mesero</th>";
                            echo "<th>Fecha</th>";
                            echo "<th>Producto</th>";
                            echo "<th>Cantidad</th>";
                            echo "<th>Precio Unitario</th>";
                            echo "<th>Costo total</th>";
                            echo "<th>Ventas totales</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $fila['Numero_venta'] . "</td>";
                                echo "<td>" . $fila['nombre_mesero'] . "</td>";
                                echo "<td>" . $fila['fecha'] . "</td>";
                                echo "<td>" . $fila['Producto'] . "</td>";
                                echo "<td>" . $fila['cantidad'] . "</td>";
                                echo "<td>" . $fila['precio_unitario'] . "</td>";
                                echo "<td>" . $fila['costo_total'] . "</td>";
                                echo "<td>" . $fila['Ventas_totales'] . "</td>";
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
                <div id="tablaVentasPorNumVenta" style="display: none;"></div>
            </div>
        </div>

        <footer>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>