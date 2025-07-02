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

$action = isset($_GET["action"]) ? $_GET["action"] : null;


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        // =======================
        // Sesión y navegación
        // =======================
        case "verInicio":
            $resultado = $controlador->consultarProductosCategoria();
            break;
        case "verAdministracion":
            if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") {
                $productos = $controlador->consultarProductos();
            } else {
                $controlador->verPagina("vista/html/admin.php");
            }
            break;
        case "verRegistro":
            $controlador->verPagina("vista/html/registrarse.php");
            break;
        case "verCarrito":
            $controlador->verPagina("vista/html/carrito.php");
            break;
        case "verMisPedidos":
            $pedidosCliente = $controlador->consultarMisPedidos($_SESSION["id"]);
            break;
        case "cerrarSesion":
            session_destroy();
            $resultado = $controlador->consultarProductosCategoria();
            break;

        // =======================
        // Usuarios
        // =======================
        case "login":
            $correo = $_POST["correo"];
            $contrasenia = $_POST["contrasena"];
            $result = $controlador->validar($correo, $contrasenia);
            if ($result) {
                $productos = $controlador->consultarProductos();
            }
            break;
        case "agregarUsuario":
            $nombre = $_POST["nombre"];
            $correo = $_POST["correo"];
            $contrasenia = $_POST["contrasena"];
            $controlador->agregarUsuario(
                $nombre,
                $correo,
                $contrasenia
            );
            break;

        // =======================
        // Categorías
        // =======================
        case "guardarCategoria":
            $categoria = $_POST["nombre"];
            $controlador->guardarCategoria($categoria);
            break;
        case "eliminarCategoria":
            $id = $_GET["id"];
            $controlador->eliminarCategoria($id);
            break;
        case "editarCategoria":
            $id = $_GET["id"];
            $categoria = $controlador->consultarCategoriaxid($id);
            break;
        case "guardarCategoriaNueva":
            $id = $_POST["idCategoria"];
            $nombre = $_POST["nombre"];
            $controlador->guardarCategoriaNueva($id, $nombre);
            break;
        case "verCategoria":
            $productos = $controlador->consultarCategorias();
            break;
        case "filtrarCategoria":
            $categoria = $_POST["categoria"];
            if ($categoria == "") {
                $resultado = $controlador->consultarProductosCategoria();
            } else {
                $resultado = $controlador->consultarProductosCategoriaxid($categoria);
            }
            break;

        // =======================
        // Productos
        // =======================
        case "guardarProducto":

            $ruta_indexphp = "uploads/";
            $extensiones = array('image/jpg', 'image/jpeg', 'image/png', 'image/bmp', 'image/webp');
            $max_tamanyo = 1024 * 1024 * 16;
            $imagen = $_FILES['imagen']['name'];
            $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
            $ruta_nuevo_destino = $ruta_indexphp . $imagen;

            if (in_array($_FILES['imagen']['type'], $extensiones)) {
                if ($_FILES['imagen']['size'] < $max_tamanyo) {
                    if (file_exists($ruta_nuevo_destino)) {
                        $nombre_sin_ext = pathinfo($imagen, PATHINFO_FILENAME);
                        $extension = pathinfo($imagen, PATHINFO_EXTENSION);
                        $imagen = $nombre_sin_ext . '_' . uniqid() . '.' . $extension;
                        $ruta_nuevo_destino = $ruta_indexphp . $imagen;
                    }
                    if (move_uploaded_file($ruta_fichero_origen, $ruta_nuevo_destino)) {
                    } else {
                        echo 'Error al guardar la imagen.';
                        exit;
                    }
                } else {
                    echo 'La imagen es demasiado grande.';
                    exit;
                }
            } else {
                echo 'El archivo no es una imagen válida.';
                exit;
            }

            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $talla = $_POST["talla"];
            $categoria = $_POST["categoria"];
            $controlador->guardarProducto(
                $nombre,
                $descripcion,
                $precio,
                $talla,
                $categoria,
                $imagen
            );
            break;
        case "eliminarProducto":
            $id = $_GET["id"];
            $controlador->eliminarProducto($id);
            break;
        case "editarProducto":
            $id = $_GET["id"];
            $productos = $controlador->consultarProductosxid($id);
            break;
        case "editarProductoxid":
            $id = $_POST["idProducto"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $talla = $_POST["talla"];
            $categoria = $_POST["categoria"];
            if (isset($_FILES['cover']['name']) && $_FILES['cover']['name'] == "") {
                $controlador->editarProductosinFoto(
                    $id,
                    $nombre,
                    $descripcion,
                    $precio,
                    $talla,
                    $categoria
                );
            } else {
                $imagen = $controlador->consultarImagen($id);
                if ($imagen["imagen"] != "") {
                    $ruta = "uploads/" . $imagen["imagen"];
                    if (file_exists($ruta)) {
                        unlink($ruta);
                    }
                }
                $ruta_indexphp = "uploads/";
                $extensiones = array('image/jpg', 'image/jpeg', 'image/png', 'image/bmp', 'image/webp');
                $max_tamanyo = 1024 * 1024 * 16; // 16 MB
                $imagen = $_FILES['imagen']['name'];
                $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
                $ruta_nuevo_destino = $ruta_indexphp . $imagen;

                if (in_array($_FILES['imagen']['type'], $extensiones)) {
                    // Validar tamaño
                    if ($_FILES['imagen']['size'] < $max_tamanyo) {
                        if (file_exists($ruta_nuevo_destino)) {
                            $nombre_sin_ext = pathinfo($imagen, PATHINFO_FILENAME);
                            $extension = pathinfo($imagen, PATHINFO_EXTENSION);
                            $imagen = $nombre_sin_ext . '_' . uniqid() . '.' . $extension;
                            $ruta_nuevo_destino = $ruta_indexphp . $imagen;
                        }
                        if (move_uploaded_file($ruta_fichero_origen, $ruta_nuevo_destino)) {
                        } else {
                            echo 'Error al guardar la imagen.';
                            exit;
                        }
                    } else {
                        echo 'La imagen es demasiado grande.';
                        exit;
                    }
                } else {
                    echo 'El archivo no es una imagen válida.';
                    exit;
                }
                $file = $cover;
                $controlador->editarProducto(
                    $id,
                    $nombre,
                    $descripcion,
                    $precio,
                    $talla,
                    $categoria,
                    $imagen
                );
            }
            break;
        case "verProducto":
            $productos = $controlador->consultarProductos();
            break;

        // =======================
        // Carrito
        // =======================

        case "agregarCarrito":
            $id = $_POST["idProducto"];
            $idUsuario = $_SESSION["id"];
            $cantidad = $_POST["cantidad"];
            $fecha = date("Y-m-d H:i:s");
            $controlador->agregarCarrito(
                $id,
                $cantidad
            );
            break;

        // =======================
        // Pedidos
        // =======================
        case "realizarPedido":
            $id = $_GET["id"];
            $controlador->PedidoFormulario($id);
            break;
        case "agregarPedido":
            $id = $_POST["idProducto"];
            $idUsuario = $_POST["idUsuario"];
            $cantidad = $_POST["cantidad"];
            $fecha = date("Y-m-d H:i:s");
            $controlador->guardarPedido($id, $idUsuario, $cantidad, $fecha);
            break;
        case "verPedidos":
            $productos = $controlador->consultarPedidos();
            break;
        case "actualizarEstadoPedido":
            $id = $_POST["pedido_id"];
            $estado = $_POST["estado"];
            $controlador->actualizarEstadoPedido($id, $estado);
            break;

        // =======================
        // Default (inicio)
        // =======================
        default:
            $resultado = $controlador->consultarProductosCategoria();
            break;
    }
} else {
    $controlador->verPagina("vista/html/catalogo.php");
}