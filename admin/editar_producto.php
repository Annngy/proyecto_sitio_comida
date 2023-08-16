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
<?php
if (!isset($_POST["SKU"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["Nombre"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["Categoria"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["Descripcion"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["Precio"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["Stock"])) {
    exit("No hay id_producto");
}
if (!isset($_POST["idcategoria"])) {
    exit("No hay idcategoria");
}
?>
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
    </nav>
    <section class="section">
        <div class="container">
            <h1 class="title">Editar Producto</h1>
            <form action="actualizarProducto.php" method="POST">
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label"><i class="fa fa-barcode"></i> SKU</label>
                            <div class="control">
                                <input class="input" disabled value="<?php echo $_POST["SKU"]?>" type="text" name="sku" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label"><i class="fa fa-shopping-basket"></i> Nombre Producto</label>
                            <div class="control">
                                <input class="input"  value="<?php echo $_POST["Nombre"]?>" type="text" name="nombre_producto" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label"><i class="fa fa-list"></i> Categoría</label>
                            <div class="control">
                                <div class="select">
                                    <select name="categoria" required>
                                            <option value="<?php echo $_POST["idcategoria"]?>" ><?php echo $_POST["Categoria"]?></option>
                                            <?php
                                            include_once "../mesero/funciones.php";
                                            $Categoria = mostrarCategoria();
                                            foreach ($Categoria as $cat) {
                                                ?>
                                                <option value="<?php echo $cat->idCat ?>"> <?php echo $cat->Nombre ?> </option>';
                                            <?php
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label"><i class="fa fa-info-circle"></i> Descripción</label>
                            <div class="control">
                                <textarea class="textarea" name="descripcion" required><?php echo $_POST["Descripcion"]?></textarea>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label"><i class="fa fa-dollar"></i> Precio</label>
                            <div class="control">
                                <input class="input" value="<?php echo $_POST["Precio"]?>" type="text" name="precio" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label"><i class="fa fa-cubes"></i> Stock</label>
                            <div class="control">
                                <input class="input" value="<?php echo $_POST["Stock"]?>" type="number" name="stock" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-link"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                   
               
            </form>
            
            <div class="control">
            <a href="producto.php" class="button is-link is-light "><i class="fa fa-close"></i> Cancelar</a>
                    </div>
                 </div>
        </div>
    </section>
</body>

</html>