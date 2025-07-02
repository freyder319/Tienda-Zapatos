<?php

class Controlador
{
    public function verPagina($ruta)
    {
        require_once($ruta);
    }
    public function validar($correo, $contrasenia)
    {
        $gestor = new GestorUsuario;
        $resultado = $gestor->validarCorreo($correo);
        if ($resultado == 1) {
            $resultado2 = $gestor->validarClave($correo, $contrasenia);
            if ($resultado2 == 1) {
                $resultado3 = $gestor->consultarDatos($correo);
                $_SESSION["rol"] = "admin";
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
    public function consultarProductos()
    {
        $gestor = new GestorProducto;
        $productos = $gestor->consultarProductos();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/productos.php");
    }
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
    public function guardarProducto($nombre, $descripcion, $precio, $talla, $categoria, $file)
    {
        $producto = new Productos($nombre, $descripcion, $precio, $talla, $categoria, $file);
        $gestor = new GestorProducto;
        $gestor->agregarProducto($producto);
        echo "<script>alert('Producto agregado correctamente');</script>";
        header("location:index.php?action=verAdministracion");
    }
    public function eliminarProducto($id)
    {
        $gestor = new GestorProducto;
        $gestor->eliminarProducto($id);
        header("location:index.php?action=verAdministracion");
    }
    public function consultarProductosxid($id)
    {
        $gestor = new GestorProducto;
        $productosxid = $gestor->consultarProductosxid($id);
        $productos = $gestor->consultarProductos();
        $categorias = $gestor->consultarCategorias();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/productos.php");
    }
    public function editarProducto($id, $nombre, $descripcion, $precio, $talla, $categoria, $file)
    {
        $producto = new Productos($nombre, $descripcion, $precio, $talla, $categoria, $file);
        $gestor = new GestorProducto;
        $gestor->editarProducto($producto, $id);
        header("location:index.php?action=verAdministracion");
    }
    public function agregarUsuario($nombre, $correo, $contrasenia)
    {
        $gestor = new GestorUsuario;
        $gestor->agregarUsuario($nombre, $correo, $contrasenia);
        $_SESSION["rol"] = "cliente";
        $_SESSION["id_usuario"] = $gestor->consultarIdUsuario($correo);
        header("location:index.php?action=verInicio");
    }
    public function consultarProductosCategoria()
    {
        $gestor = new GestorProducto;
        $productos = $gestor->consultarProductosTotales();
        $categorias = $gestor->consultarCategorias();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/catalogo.php");
    }
    public function PedidoFormulario($id)
    {
        $gestor = new GestorProducto;
        $id = $id;
        require_once("vista/html/realizarPedido.php");
    }
    public function guardarPedido($id, $idUsuario, $cantidad, $fecha)
    {
        $gestor = new GestorPedido;
        $pedido = new Pedido($id, $idUsuario, $cantidad, $fecha);
        $gestor->guardarPedido($pedido);
        header("location:index.php?action=verInicio&mensaje=1");
    }
    public function consultarProductosCategoriaxid($categoria)
    {
        $gestor = new GestorProducto;
        $productos = $gestor->consultarProductosCategoria($categoria);
        $categorias = $gestor->consultarCategorias();
        $categoriasSelect = $gestor->consultarCategorias();
        require_once("vista/html/catalogo.php");
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
    public function consultarCategorias()
    {
        $gestor = new GestorProducto;
        $categorias = $gestor->consultarCategorias();
        require_once("vista/html/categorias.php");
    }
    public function consultarPedidos()
    {
        $gestor = new GestorProducto;
        $pedidos = $gestor->consultarPedidos();
        require_once("vista/html/pedidos.php");
    }
    public function editarProductosinFoto($id, $nombre, $descripcion, $precio, $talla, $categoria)
    {
        $producto = new Productos($nombre, $descripcion, $precio, $talla, $categoria, "");
        $gestor = new GestorProducto;
        $gestor->editarProductoSinFoto($producto, $id);
        header("location:index.php?action=verAdministracion");
    }
    public function consultarImagen($id)
    {
        $gestor = new GestorProducto;
        $imagen = $gestor->consultarImagen($id);
        return $imagen;
    }
    public function actualizarEstadoPedido($id, $estado)
    {
        $gestor = new GestorPedido;
        $gestor->actualizarEstadoPedido($id, $estado);
        header("location:index.php?action=verPedidos");
    }
}