<?php
include_once 'includes/database.php';

session_start();

if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
        case 1:
            header('location:admin/index.php');
            break;

        case 2:
            header('location:mesero/index.php');
            break;

        case 3:
            header('location:cosinero/index.php');
            break;

        default:
            header('location: index.php');
            break;
    }
}

if(isset($_POST['usuario']) && isset($_POST['contrasena'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['contrasena'];

    $db = new Database();
    $query = $db->connect()->prepare('SELECT * FROM usuario where correo = :usuario AND password = :password');
    $query->execute(['usuario' => $usuario, 'password' => $password]);

    $row = $query->fetch(PDO::FETCH_ASSOC);

        $Id = $row['id'];
        $_SESSION['id'] = $Id;

        $Us = $row['nombre'];
        $_SESSION['nombre'] = $Us;

        $email = $row['correo'];
        $_SESSION['correo'] = $email;

        $Psw = $row['password'];
        $_SESSION['password'] = $Psw;

        $status = $row['status_usuario'];
        $_SESSION['status_usuario'] = $status;

    if($row){

        $rol = $row['rol_id'];
        $_SESSION['rol'] = $rol;

        

        switch($rol){
            case 1:
                header('location:admin/index.php');
                break;

            case 2:
                header('location:mesero/index.php');
                break;

            case 3:
                header('location:cosinero/index.php');
                break;

            default:
                header('location: index.php');
                break;
        }
    }else{
        // no existe el usuario
        echo "Nombre de usuario o contraseña incorrecto";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Not Only Friends</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
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
                            <a class="nav-link" href="contacto.php">Contacto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <img src="fondo.png" alt="Tienda de comida rápida" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2>Bienvenido a nuestra tienda de comida rápida</h2>
                    <p>Ofrecemos una amplia selección de deliciosos alimentos para satisfacer tus antojos. Nuestro objetivo es proporcionarte los mejores productos de calidad y un excelente servicio al cliente.</p>
                    <p>¡Estamos listos para atenderte!</p>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Inicia sesión</h5>
                            <form action="#" method="POST">
                                <div class="mb-3">
                                    <label for="usuario" class="form-label">Correo</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contrasena" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                            </form>
                        </div>
                    </div>
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