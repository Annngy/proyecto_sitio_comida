<?php

function obtenerUltimoIdPedido()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT MAX(id) AS id FROM pedido");
    $sentencia->execute();
    return $sentencia->fetchAll();
}

function actualizaStatus($status,$idusuario)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL actualizaStatusUsuario(?,?)");
    return $sentencia->execute([$status,$idusuario]);
}

function actualizaStatuspedido($status,$idpedido)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL CambiarStatusPedido(?,?)");
    return $sentencia->execute([$status,$idpedido]);
}

function insertarDetallePedido($idPedido,$idProducto,$comentario)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad, comentario)
                                VALUES (?, ?, ?, ?)");
    return $sentencia->execute([$idProducto, $idPedido, 1, $comentario]);
}

function insertarVenta($id_msero,$total)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL InsertarNuevaVenta2(?,?)");
    return $sentencia->execute([$id_msero,$total]);
}


function insertarDetalleventa($producto_id,$precio)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL InsertarNuevoDetalleVenta(?,?,?)");
    return $sentencia->execute([$producto_id, 1, $precio]);
}

function obtenerPedidosEnCarrito($idPedido)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL ConsultaPedidosCarrito(?)");
    $sentencia->execute([$idPedido]);
    return $sentencia->fetchAll();
}

function consultaDetallePedido()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL ConsultarTodosLosPedidos()");
    return $sentencia->fetchAll();
}

function consultaDetallePedidoBuscar($busqueda)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL ConsultarTodosLosPedidosYBusqueda(?)");
    $sentencia->execute([$busqueda]);
    return $sentencia->fetchAll();
}

function ConsultarTodasLasVentas($busqueda)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL ConsultarTodasLasVentas(?)");
    $sentencia->execute([$busqueda]);
    return $sentencia->fetchAll();
}

function  ConsultaProductoPorNombre($busqueda)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL  ConsultaProductoPorNombre(?)");
    $sentencia->execute([$busqueda]);
    return $sentencia->fetchAll();
}
function quitarProductoDelCarrito($idPedido,$idProducto)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("DELETE FROM detalle_pedido WHERE pedido_id = ? AND producto_id = ?");
    return $sentencia->execute([$idPedido, $idProducto]);
}

function obtenerProductos()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->query("CALL ConsultaTodosLosProductos()");
    return $sentencia->fetchAll();
}

function buscarProductos($busqueda)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL ConsultaProductoPorNombre(?)");
    $sentencia->execute([$busqueda]);
    return $sentencia->fetchAll();
}


/*
function productoYaEstaEnCarrito($idProducto)
{
    $ids = obtenerIdsDeProductosEnCarrito();
    foreach ($ids as $id) {
        if ($id == $idProducto) return true;
    }
    return false;
}
*/
function obtenerIdsDeProductosEnCarrito($idPedido)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("SELECT producto_id FROM detalle_pedido WHERE pedido_id = ?");
    $sentencia->execute([$idPedido]);
    return $sentencia->fetchAll(PDO::FETCH_COLUMN);
}

function agregarProductoAlCarrito($idProducto)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $idSesion = session_id();
    $sentencia = $bd->prepare("INSERT INTO carrito_usuarios(id_sesion, id_producto) VALUES (?, ?)");
    return $sentencia->execute([$idSesion, $idProducto]);
}

function iniciarSesionSiNoEstaIniciada()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function eliminarProducto($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM producto WHERE id = ?");
    return $sentencia->execute([$id]);
}

function guardarProducto($nombre, $precio, $descripcion)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("INSERT INTO productos(nombre, precio, descripcion) VALUES(?, ?, ?)");
    return $sentencia->execute([$nombre, $precio, $descripcion]);
}


function obtenerConexion()
{
    $password = "ars1709cyj";
    $user = "root";
    $dbName = "proyectomanuel";
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}

function mostrarCategoria()
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->query("CALL ConsultaCategoria()");
    return $sentencia->fetchAll();
}


function actualizarProducto($Nombre,$Categoria,$Descripcion, $Precio, $Stock, $producto_id)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL ActualizarProducto(?,?,?,?,?,?)");
    return $sentencia->execute([$Nombre,$Categoria,$Descripcion, $Precio, $Stock, $producto_id]);
}

function insertarProducto($Nombre,$Descripcion,$Precio,$Stock, $categoria_id)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL InsertarNuevosProductos(?,?,?,?,?)");
    return $sentencia->execute([$Nombre,$Descripcion,$Precio,$Stock, $categoria_id]);
}

function buscarusuario($busqueda)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL Consulta_Usuario_por_Nombre_rol(?)");
    $sentencia->execute([$busqueda]);
    return $sentencia->fetchAll();
}

function eliminarUsuario($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM usuario WHERE id = ?");
    return $sentencia->execute([$id]);
}

function actualizarUsuario($Nombre,$correo,$pass, $rol, $status, $id_usuario)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL ActualizarUsuario(?,?,?,?,?,?)");
    return $sentencia->execute([$Nombre,$correo,$pass, $rol, $status, $id_usuario]);
}



function insertarUsuario($nombreN,$correoN,$contraseñaN, $rolN, $status)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL InsertarNuevoUsuario(?,?,?,?,?)");
    return $sentencia->execute([$nombreN,$correoN,$contraseñaN, $rolN, $status]);
}

function  ConsultaCategoria($busqueda)
{
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL  ConsultaMostrarCategorias(?)");
    $sentencia->execute([$busqueda]);
    return $sentencia->fetchAll();
}

function eliminarcategoria($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM categoria WHERE id = ?");
    return $sentencia->execute([$id]);
}

function actualizarcategoria($Nombre,$id)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("UPDATE categoria SET nombre = ? WHERE id = ?");
    return $sentencia->execute([$Nombre,$id]);
}

function insertarCategoria($nombreN)
{
    // Ligar el id del producto con el usuario a través de la sesión
    $bd = obtenerConexion();
    iniciarSesionSiNoEstaIniciada();
    $sentencia = $bd->prepare("CALL InsertarNuevaCategoria(?)");
    return $sentencia->execute([$nombreN]);
}