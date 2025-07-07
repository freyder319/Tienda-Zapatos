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
        $sql = "INSERT INTO productos (nombre, especificaciones, precio, id_categoria, marca, modelo, tipo) 
                VALUES ('$nombre', '$especificacion', '$precio', '$categoria', '$marca', '$modelo', '$categoria')";
        $conexion->consulta($sql);
        $ultimoId = $conexion->obtenerUltimoIdInsertado();
        $conexion->cerrar();
        return $ultimoId;
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

    public function consultarUltimoIdProducto()
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT MAX(id) AS ultimo_id FROM productos";
        $conexion->consulta($sql);
        $result = $conexion->ObtenerId();
        $conexion->cerrar();
        return $result;
    }
    public function editarProducto(productos $productos, $id){
        $nombre=$productos->obtenernombre();
        $descripcion=$productos->obtenerEspecificacion();
        $precio=$productos->obtenerprecio();
        $modelo=$productos->obtenerModelo();
        $marca=$productos->obtenermarca();
        $categoria=$productos->obtenertipo();
        $conexion=new conexion;
        $conexion->abrir();
        $sql="UPDATE productos SET nombre='$nombre', especificaciones='$descripcion' , precio='$precio', marca='$marca', modelo='$modelo', id_categoria='$categoria' WHERE id='$id'";

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
        productos.marca
        FROM productos
        JOIN categorias ON productos.id_categoria = categorias.id";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }

    public function editarProductoSinFoto(productos $productos, $id){
        $nombre=$productos->obtenernombre();
        $descripcion=$productos->obtenerEspecificacion();
        $precio=$productos->obtenerprecio();
        $marca=$productos->obtenermarca();
        $modelo=$productos->obtenerModelo();
        $categoria=$productos->obtenertipo();
        $conexion=new conexion;
        $conexion->abrir();
        $sql = "UPDATE productos SET nombre='$nombre', especificaciones='$descripcion' , precio='$precio', marca='$marca', modelo='$modelo', id_categoria='$categoria' WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
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
        $sql = "SELECT nombre_archivo FROM imagenes WHERE id_producto='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarImagenesProducto(){
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT p.id AS id_producto, p.nombre, i.nombre_archivo
            FROM productos p
            LEFT JOIN imagenes i ON p.id = i.id_producto";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function eliminarImagenesProducto($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "DELETE FROM imagenes WHERE id_producto='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }   
    public function consultarImagenesxid($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT * FROM imagenes WHERE id_producto='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function eliminarImagen($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "DELETE FROM imagenes WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarImagenxid($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT nombre_archivo FROM imagenes WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerUnaFila();
        $conexion->cerrar();
        return $result;
    }
    
}