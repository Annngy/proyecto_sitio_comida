<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header('location: ../index.php');
} else {
    if ($_SESSION['rol'] != 3) {
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
    <title>Cosinero</title>
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
    <div class="columns">
        <div class="column">
            <div class="card">
                <div class="card-content">
                    <div class="columns">
                        <div class="column">
                            <h2 class="title">Estado del servicio</h2>
                            <p>Cosinero: <?php echo $Us;?><p>
                            <p>Estatus actual: <label style="color:<?php echo ($status == 'activo' ||  $status == 'Activo') ? 'green' : 'red'; ?>"><?php echo $status?></label></p>
                            <p>Seleccione el estado del servicio:</p>
                            <br>
                            <?php if($status == 'activo'  || $status == 'Activo'): ?>

                                <form action="../includes/actualizar_status_usuario.php" method="post">
                                    <input type="hidden" name="id_usuario" value="<?php echo $Id  ?>">
                                    <input type="hidden" name="status" value="Inactivo">                                  
                                    <button class="button is-success" disabled>En servicio</button>
                                     <button class="button is-danger">Fuera de servicio</button>
                                </form>
                            
                    
                              
                        </div>

                            <?php else: ?>

                                <form action="../includes/actualizar_status_usuario.php" method="post">
                                   
                                    <input type="hidden" name="id_usuario" value="<?php echo $Id  ?>">
                                    <input type="hidden" name="status" value="Activo">                                  
                                    <button class="button is-success">En servicio</button>
                                    <button class="button is-danger" disabled>Fuera de servicio</button>
                                </form>
                            
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </main>
     <footer>
    </footer>
 </body>
</html>