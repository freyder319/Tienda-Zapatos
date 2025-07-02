<?php
require_once("Controlador/Controlador.php");
require_once("Modelo/Conexion.php");
require_once("Modelo/GestorUsuario.php");
require_once("Modelo/GestorProductos.php");
require_once("Modelo/GestorCategoria.php");
require_once("Modelo/Productos.php");
require_once("Modelo/GestorPedido.php");
require_once("Modelo/Pedido.php");

$controlador = new Controlador();

session_start();

if (isset($_GET["action"])) {
    if ($_GET["action"] == "verInicio") {
        $resultado = $controlador->consultarProductosCategoria();
    } elseif ($_GET["action"] == "verAdministracion") {
        if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") {
            $productos = $controlador->consultarProductos();
        } else {
            $controlador->verPagina("vista/html/admin.php");
        }
    } elseif ($_GET["action"] == "verRegistro") {
        $controlador->verPagina("vista/html/registrarse.php");
    } elseif ($_GET["action"] == "login") {
        $correo = $_POST["correo"];
        $contrasenia = $_POST["contrasena"];
        $result = $controlador->validar($correo, $contrasenia);
        if ($result) {
            $productos = $controlador->consultarProductos();
        }
    } elseif ($_GET["action"] == "guardarCategoria") {
        $categoria = $_POST["nombre"];
        $controlador->guardarCategoria($categoria);
    } elseif ($_GET["action"] == "eliminarCategoria") {
        $id = $_GET["id"];
        $controlador->eliminarCategoria($id);
    } elseif ($_GET["action"] == "guardarProducto") {
        $ruta_indexphp = "uploads";
        $extensiones = array(0 => 'image/jpg', 1 => 'image/jpeg', 2 => 'image/png');
        $max_tamanyo = 1024 * 1024 * 16;
        $cover = $_FILES['cover']['name'];
        $ruta_fichero_origen = $_FILES['cover']['tmp_name'];
        $ruta_nuevo_destino = $ruta_indexphp . '/' . $_FILES['cover']['name'];
        if (in_array($_FILES['cover']['type'], $extensiones)) {
            echo 'Es una imagen';
            if ($_FILES['cover']['size'] < $max_tamanyo) {
                echo 'Pesa menos de 1 MB';
                if (move_uploaded_file($ruta_fichero_origen, $ruta_nuevo_destino)) {
                    echo 'Fichero guardado con éxito';
                }
            }
        }
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $talla = $_POST["talla"];
        $categoria = $_POST["categoria"];
        $controlador->guardarProducto($nombre, $descripcion, $precio, $talla, $categoria, $cover);
    } elseif ($_GET["action"] == "eliminarProducto") {
        $id = $_GET["id"];
        $controlador->eliminarProducto($id);
    } elseif ($_GET["action"] == "editarProducto") {
        $id = $_GET["id"];
        $productos = $controlador->consultarProductosxid($id);
    } elseif ($_GET["action"] == "editarProductoxid") {
        $id = $_POST["idProducto"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $talla = $_POST["talla"];
        $categoria = $_POST["categoria"];
        if (isset($_FILES['cover']['name']) && $_FILES['cover']['name'] == "") {
            $controlador->editarProductosinFoto($id, $nombre, $descripcion, $precio, $talla, $categoria);
        } else {
            $imagen = $controlador->consultarImagen($id);
            if ($imagen["imagen"] != "") {
                $ruta = "uploads/" . $imagen["imagen"];
                if (file_exists($ruta)) {
                    unlink($ruta);
                }
            }
            $ruta_indexphp = "uploads";
            $extensiones = array(0 => 'image/jpg', 1 => 'image/jpeg', 2 => 'image/png');
            $max_tamanyo = 1024 * 1024 * 16;
            $cover = $_FILES['cover']['name'];
            $ruta_fichero_origen = $_FILES['cover']['tmp_name'];
            $ruta_nuevo_destino = $ruta_indexphp . '/' . $_FILES['cover']['name'];
            if (in_array($_FILES['cover']['type'], $extensiones)) {
                echo 'Es una imagen';
                if ($_FILES['cover']['size'] < $max_tamanyo) {
                    echo 'Pesa menos de 1 MB';
                    if (move_uploaded_file($ruta_fichero_origen, $ruta_nuevo_destino)) {
                        echo 'Fichero guardado con éxito';
                    }
                }
            }
            $file = $cover;
            $controlador->editarProducto($id, $nombre, $descripcion, $precio, $talla, $categoria, $file);
        }
    } elseif ($_GET["action"] == "cerrarSesion") {
        session_destroy();
        $resultado = $controlador->consultarProductosCategoria();
    } elseif ($_GET["action"] == "agregarUsuario") {
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $contrasenia = $_POST["contrasena"];
        $controlador->agregarUsuario($nombre, $correo, $contrasenia);
    } elseif ($_GET["action"] == "realizarPedido") {
        $id = $_GET["id"];
        $controlador->PedidoFormulario($id);
    } elseif ($_GET["action"] == "agregarPedido") {
        $id = $_POST["idProducto"];
        $idUsuario = $_POST["idUsuario"];
        $cantidad = $_POST["cantidad"];
        $fecha = date("Y-m-d H:i:s");
        $controlador->guardarPedido($id, $idUsuario, $cantidad, $fecha);
    } elseif ($_GET["action"] == "filtrarCategoria") {
        $categoria = $_POST["categoria"];
        if ($categoria == "") {
            $resultado = $controlador->consultarProductosCategoria();
        } else {
            $resultado = $controlador->consultarProductosCategoriaxid($categoria);
        }
    } elseif ($_GET["action"] == "editarCategoria") {
        $id = $_GET["id"];
        $categoria = $controlador->consultarCategoriaxid($id);
    } elseif ($_GET["action"] == "guardarCategoriaNueva") {
        $id = $_POST["idCategoria"];
        $nombre = $_POST["nombre"];
        $controlador->guardarCategoriaNueva($id, $nombre);
    } elseif ($_GET["action"] == "verCategoria") {
        $productos = $controlador->consultarCategorias();
    } elseif ($_GET["action"] == "verPedidos") {
        $productos = $controlador->consultarPedidos();
    } elseif ($_GET["action"] == "verProducto") {
        $productos = $controlador->consultarProductos();
    } elseif ($_GET["action"] == "actualizarEstadoPedido") {
        $id = $_POST["pedido_id"];
        $estado = $_POST["estado"];
        $controlador->actualizarEstadoPedido($id, $estado);
    }
} else {
    $resultado = $controlador->consultarProductosCategoria();
}