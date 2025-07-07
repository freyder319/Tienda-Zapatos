<?php
class Controlador
{
    // =======================
    // Sesión y navegación
    // =======================
    public function verPagina($ruta)
    {
        require_once($ruta);
    }

    public function consultarProductos()
    {
        $gestor = new GestorProducto;
        $productos = $gestor->consultarProductos();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/productos.php");
    }

    // =======================
    // Usuarios
    // =======================
    public function validar($correo, $contrasenia)
    {
        $gestor = new GestorUsuario;
        $resultado = $gestor->validarCorreo($correo);
        if ($resultado == 1) {
            $resultado2 = $gestor->validarClave($correo, $contrasenia);
            if ($resultado2 == 1) {
                $resultado3 = $gestor->consultarDatos($correo);
                $_SESSION["rol"] = $resultado3["rol"];
                $_SESSION["id"] = $resultado3["id"];
                if ($_SESSION["rol"] == "admin") {
                    header("location:index.php?action=verAdministracion");
                } else {
                    header("location:index.php?action=verInicio");
                }
                $validado = True;
                return $validado;
            } else {
                header("location:index.php?action=verAdministracion&error=2");
            }
        } else {
            header("location:index.php?action=verAdministracion&error=1");
        }
    }

    public function agregarUsuario($nombre, $correo, $contrasenia)
    {
        $gestor = new GestorUsuario;
        $gestor->agregarUsuario($nombre, $correo, $contrasenia);
        $_SESSION["rol"] = "cliente";
        $_SESSION["id_usuario"] = $gestor->consultarIdUsuario($correo);
        header("location:index.php?action=verInicio");
    }

    // =======================
    // Categorías
    // =======================
    public function guardarCategoria($categoria)
    {
        $gestor = new Categoria;
        $gestor->guardarCategoria($categoria);
        header("location:index.php?action=verAdministracion");
    }

    public function eliminarCategoria($id)
    {
        $gestor = new Categoria;
        $gestor->eliminarCategoria($id);
        header("location:index.php?action=verAdministracion");
    }

    public function consultarCategorias()
    {
        $gestor = new GestorProducto;
        $categorias = $gestor->consultarCategorias();
        require_once("vista/html/categorias.php");
    }

    public function consultarCategoriaxid($id)
    {
        $gestor = new Categoria;
        $gestor2 = new GestorProducto;
        $categoriaxid = $gestor->consultarCategoriaxid($id);
        $productos = $gestor2->consultarProductos();
        $categorias = $gestor2->consultarCategorias();
        $categoriasSelect = $gestor2->consultarCategorias();
        require_once("vista/html/admin.php");
    }

    public function guardarCategoriaNueva($id, $nombre)
    {
        $gestor = new Categoria;
        $gestor->editarCategoria($id, $nombre);
        header("location:index.php?action=verAdministracion");
    }

    // =======================
    // Productos
    // =======================
    public function guardarProducto($nombre, $especificacion, $precio, $marca, $modelo, $tipo)
    {
        $producto = new Productos($nombre, $especificacion, $precio, $marca, $modelo, $tipo);
        $gestor = new GestorProducto;
        $idProducto = $gestor->agregarProducto($producto);

        if (!$idProducto) {
            echo "<script>alert('Error al agregar el producto');</script>";
            return null;
        } else {
            return $idProducto;
        }
    }

    public function guardarImagen($id_producto, $file)
    {
        $gestor = new GestorProducto;
        $gestor->guardarImagen($id_producto, $file);
        echo "<script>alert('Producto agregado correctamente');</script>";
        header("location:index.php?action=verAdministracion");
    }

    public function eliminarProducto($id)
    {
        $gestor = new GestorProducto;
        $eliminarImagenes = $gestor->consultarImagen($id);
        if ($eliminarImagenes) {
            foreach ($eliminarImagenes as $imagen) {
                $ruta = "uploads/" . $imagen['nombre_archivo'];
                if (file_exists($ruta)) {
                    unlink($ruta);
                }
            }
        }
        $eliminarImagenesProducto = $gestor->eliminarImagenesProducto($id);
        $gestor->eliminarProducto($id);
        header("location:index.php?action=verAdministracion");
    }

    public function consultarProductosxid($id)
    {
        $gestor = new GestorProducto;
        $productosxid = $gestor->consultarProductosxid($id);
        $productos = $gestor->consultarProductos();
        $imagenes = $gestor->consultarImagenesxid($id);
        $categorias = $gestor->consultarCategorias();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/productos.php");
    }

    public function editarProducto($nombre, $especificacion, $precio, $marca, $modelo, $tipo, $id)
    {
        $producto = new Productos($nombre, $especificacion, $precio, $marca, $modelo, $tipo);
        $gestor = new GestorProducto;
        $gestor->editarProducto($producto, $id);
        header("location:index.php?action=verAdministracion");
    }

    public function editarProductosinFoto($nombre, $especificacion, $precio, $marca, $modelo, $categoria, $id)
    {
        $producto = new Productos($nombre, $especificacion, $precio, $marca, $modelo, $categoria);
        $gestor = new GestorProducto;
        $gestor->editarProductoSinFoto($producto, $id);
        header("location:index.php?action=verAdministracion");
    }

    public function consultarProductosCategoria()
    {
        $gestor = new GestorProducto;
        $productos = $gestor->consultarProductosTotales();
        $imagenes = $gestor->consultarImagenesProducto();
        $categorias = $gestor->consultarCategorias();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/catalogo.php");
    }

    public function consultarProductosCategoriaxid($categoria)
    {
        $gestor = new GestorProducto;
        $productos = $gestor->consultarProductosCategoria($categoria);
        $categorias = $gestor->consultarCategorias();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/catalogo.php");
    }

    // =======================
    // Carrito
    // =======================
    public function agregarCarrito($idProducto, $cantidad)
    {
        $idProducto = (string) $idProducto;
        $cantidad = intval($cantidad);

        $gestor = new GestorProducto;
        $productosResult = $gestor->consultarProductosxid($idProducto);
        $productos = [];
        if ($productosResult instanceof mysqli_result) {
            while ($row = $productosResult->fetch_assoc()) {
                $productos[] = $row;
            }
        }

        if ($productos && count($productos) > 0) {
            $producto = $productos[0];

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            if (isset($_SESSION['carrito'][$idProducto])) {
                $_SESSION['carrito'][$idProducto]['cantidad'] += $cantidad;
            } else {
                $_SESSION['carrito'][$idProducto] = [
                    'idProducto' => $producto['id_producto'],
                    'nombre' => $producto['nombre'],
                    'marca' => $producto['marca'],
                    'modelo' => $producto['modelo'],
                    'cantidad' => $cantidad,
                    'precio' => $producto['precio']
                ];
            }

            $carritoCliente = $_SESSION['carrito'];
            require_once("vista/html/carrito.php");
            exit;

        } else {
            echo "<script>alert('Producto no encontrado');</script>"
                . "<script>window.location.href='index.php?action=verInicio';</script>";
            exit;
        }
    }

    public function mostrarCarrito()
    {
        $carritoCliente = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
        require_once("vista/html/carrito.php");
    }

    public function eliminarCarrito()
    {
        if (isset($_SESSION['carrito'])) {
            unset($_SESSION['carrito']);
            echo "<script>alert('Carrito eliminado.');</script>"
                . "<script>window.location.href='index.php?action=verInicio';</script>";
        } else {
            echo "<script>alert('El carrito ya está vacío.');</script>"
                . "<script>window.location.href='index.php?action=verInicio';</script>";
            return;
        }
    }

    public function eliminarProductoCarrito($idProducto)
    {
        if (isset($_SESSION['carrito'][$idProducto])) {
            unset($_SESSION['carrito'][$idProducto]);
            echo "<script>alert('Producto eliminado del carrito.');</script>"
                . "<script>window.location.href='index.php?action=verCarrito';</script>";
        } else {
            echo "<script>alert('El producto no está en el carrito.');</script>"
                . "<script>window.location.href='index.php?action=verCarrito';</script>";
        }
    }

    // =======================
    // Pedidos
    // =======================
    public function PedidoFormulario($id)
    {
        $gestor = new GestorProducto;
        $idProducto = $id;
        require_once("vista/html/agregarCarrito.php");
    }

    public function guardarPedido($idProducto, $idUsuario, $fecha)
    {
        $gestor = new GestorPedido;
        $pedido = new Pedido(NULL, $idProducto, $idUsuario, $fecha, 'pendiente');
        $gestor->guardarPedido($pedido);
        header("location:index.php?action=verInicio&mensaje=1");
    }

    public function confirmarPedido()
    {
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
            $gestor = new GestorPedido;
            $fecha = date("Y-m-d H:i:s");
            $total = 0; 

            foreach ($_SESSION['carrito'] as $producto) {
                $total += $producto['precio'] * $producto['cantidad'];
            }

            $pedido = new Pedido(NULL, $_SESSION['id'], $fecha, 'Pendiente', $total);
            $idPedido = $gestor->guardarPedido($pedido);

            foreach ($_SESSION['carrito'] as $producto) {
                $detallePedido = new DetallePedido(
                    $idPedido,
                    $producto['idProducto'],
                    $producto['cantidad'],
                    $producto['precio'],
                    NULL
                );
                $gestor->guardarDetallePedido($detallePedido);
            }
            unset($_SESSION['carrito']);
            echo "<script>alert('Pedido realizado exitosamente.');</script>"
                . "<script>window.location.href='index.php?action=verInicio';</script>";
        } else {
            echo "<script>alert('El carrito está vacio.');</script>"
                . "<script>window.location.href='index.php?action=verInicio';</script>";
        }
    }

    public function consultarPedidos()
    {
        $gestor = new GestorPedido;
        $pedidos = $gestor->consultarPedidos();
        require_once("vista/html/pedidos.php");
    }

    public function consultarPedidosCliente($id)
    {
        $gestor = new GestorPedido;
        $pedidosCliente = $gestor->consultarPedidosCliente($id);
        require_once("vista/html/misPedidos.php");
    }

    public function actualizarEstadoPedido($id, $estado)
    {
        $gestor = new GestorPedido;
        $gestor->actualizarEstadoPedido($id, $estado);
        header("location:index.php?action=verPedidos");
    }

    public function eliminarImagen($id)
    {
        $gestor = new GestorProducto;
        $imagen = $gestor->consultarImagenxid($id);
        if ($imagen) {
            $ruta = "uploads/" . $imagen['nombre_archivo'];
            if (file_exists($ruta)) {
                unlink($ruta);
            }
        }
        $gestor->eliminarImagen($id);
        header("location:index.php?action=verAdministracion");
    }
}