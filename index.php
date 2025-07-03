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
            // Datos de la imagen y el producto
            $ruta_indexphp = "uploads";
            $extensiones = array('image/jpg', 'image/jpeg', 'image/png');
            $max_tamanyo = 1024 * 1024 * 16; // 16MB

            // Array para almacenar los nombres de las imágenes subidas
            $nombres_archivos = array(); 

            // Subir todas las imágenes
            foreach ($_FILES['cover']['name'] as $key => $nombre_archivo) {
                $tipo = $_FILES['cover']['type'][$key];
                $tamano = $_FILES['cover']['size'][$key];
                $tmp_name = $_FILES['cover']['tmp_name'][$key];

                // Verificamos que la extensión sea válida y el tamaño sea correcto
                if (in_array($tipo, $extensiones) && $tamano < $max_tamanyo) {
                    // Crear una ruta única para la imagen (puedes agregar un prefijo único para evitar sobreescribir)
                    $nombre_archivo = time() . '_' . basename($nombre_archivo);
                    $ruta_nuevo_destino = $ruta_indexphp . '/' . $nombre_archivo;

                    // Mover el archivo a la carpeta de destino
                    if (move_uploaded_file($tmp_name, $ruta_nuevo_destino)) {
                        $nombres_archivos[] = $nombre_archivo; // Guardamos el nombre de la imagen para agregarla al producto
                    }

                }
            } else {
                echo 'El archivo no es una imagen válida.';
                exit;
            }

            // Resto de los datos del formulario

            $nombre = $_POST["nombre"];
            $especificacion = $_POST["especificacion"];
            $precio = $_POST["precio"];

            $marca = $_POST["marca"];
            $modelo = $_POST["modelo"];
            $tipo = $_POST["categoria"];
            $id_producto = $controlador->guardarProducto($nombre, $especificacion, $precio, $marca, $modelo, $tipo);

            // Ahora guardamos las imágenes asociadas a ese producto
            foreach ($nombres_archivos as $file) {
                // Guardamos la imagen en la tabla de imágenes
                $controlador->guardarImagen($id_producto, $file);
            }

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

                $controlador->editarProductosinFoto($nombre, $especificacion, $precio, $marca, $modelo, $tipo, $file,$id);

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
                $controlador->editarProducto($nombre, $especificacion, $precio, $marca, $modelo, $tipo, $file,$id);
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