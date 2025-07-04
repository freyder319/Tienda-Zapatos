<?php

class GestorProducto
{
    public function consultarProductos()
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT productos.id AS id_producto,
        categorias.nombre AS nombre_categoria,
        productos.nombre,
        productos.especificaciones,
        productos.precio,
        productos.modelo,
        productos.marca
        FROM productos
        JOIN categorias ON productos.id_categoria = categorias.id;";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarCategorias()
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT * FROM categorias ";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function agregarProducto(productos $productos)
    {
        $nombre = $productos->obtenernombre();
        $especificacion = $productos->obtenerEspecificacion();
        $precio = $productos->obtenerprecio();
        $modelo = $productos->obtenerModelo();
        $marca = $productos->obtenermarca();
        $categoria = $productos->obtenertipo();
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "INSERT INTO productos VALUES (NULL,'$nombre','$especificacion','$precio','$categoria','$marca','$modelo','$categoria')";
        $conexion->consulta($sql);
        $result = $conexion->ObtenerId();
        $conexion->cerrar();
        return $result;
    }
    public function guardarImagen($id_producto, $file)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "INSERT INTO imagenes values (NULL,'$id_producto','$file')";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function eliminarProducto($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "DELETE FROM productos WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarProductosxid($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT productos.id AS id_producto,
        categorias.nombre AS nombre_categoria,
        categorias.id as id_categoria,
        productos.nombre,
        productos.especificaciones,
        productos.precio,
        productos.modelo,
        productos.marca
        FROM productos
        JOIN categorias ON productos.id_categoria = categorias.id WHERE productos.id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function editarProducto(productos $productos, $id)
    {
        $nombre = $productos->obtenernombre();
        $descripcion = $productos->obtenerEspecificacion();
        $precio = $productos->obtenerprecio();
        $talla = $productos->obtenerModelo();
        $categoria = $productos->obtenertipo();
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', id_categoria='$categoria' WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarProductosTotales()
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT productos.id AS id_producto,
        categorias.nombre AS nombre_categoria,
        categorias.id as id_categoria,
        productos.nombre,
        productos.especificaciones,
        productos.precio,
        productos.modelo,
        productos.marca,
        imagenes.nombre_archivo as imagen
        FROM productos
        JOIN categorias ON productos.id_categoria = categorias.id
        LEFT JOIN imagenes ON productos.id = imagenes.id_producto";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function editarProductoSinFoto(productos $productos, $id)
    {
        $nombre = $productos->obtenernombre();
        $descripcion = $productos->obtenerEspecificacion();
        $precio = $productos->obtenerprecio();
        $talla = $productos->obtenerModelo();
        $categoria = $productos->obtenertipo();
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', id_categoria='$categoria' WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarPedidos()
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT 
        p.id AS pedido_id,
        u.nombre AS nombre_usuario,
        pr.nombre AS nombre_producto,
        pr.id as id_producto,
        p.cantidad,
        p.fecha,
        p.estado
        FROM pedidos p
        INNER JOIN usuarios u ON p.id_usuario = u.id
        INNER JOIN productos pr ON p.id_producto = pr.id;";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarMisPedidos($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT 
        p.id AS pedido_id,
        u.nombre AS nombre_usuario,
        pr.nombre AS nombre_producto,
        pr.id as id_producto,
        p.cantidad,
        p.fecha,
        p.estado
        FROM pedidos p
        INNER JOIN usuarios u ON p.id_usuario = u.id
        INNER JOIN productos pr ON p.id_producto = pr.id 
        WHERE u.id='$id';";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarProductosCategoria($categoria)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT productos.id AS id_producto,
        categorias.nombre AS nombre_categoria,
        categorias.id as id_categoria,
        productos.nombre,
        productos.especificaciones,
        productos.precio,
        productos.modelo,
        productos.marca,
        imagenes.nombre_archivo as imagen
        FROM productos
        JOIN categorias ON productos.id_categoria = categorias.id
        LEFT JOIN imagenes ON productos.id = imagenes.id_producto
        WHERE categorias.id='$categoria'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarImagen($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT imagen FROM productos WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerUnaFila();
        $conexion->cerrar();
        return $result;
    }
}