<?php

class GestorProducto{
    public function consultarProductos(){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT productos.id AS id_producto,
       categorias.nombre AS nombre_categoria,
       productos.nombre,
       productos.precio
FROM productos
JOIN categorias ON productos.id_categoria = categorias.id;";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarCategorias(){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT * FROM categorias ";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function agregarProducto(productos $productos){
        $nombre=$productos->obtenernombre();
        $descripcion=$productos->obtenerdescripcion();
        $precio=$productos->obtenerprecio();
        $talla=$productos->obtenertalla();
        $categoria=$productos->obtenercategoria();
        $file=$productos->obtenerimagen();
        $conexion=new conexion;
        $conexion->abrir();
        $sql="INSERT INTO productos VALUES (NULL,'$nombre','$precio','$file','$categoria','$talla')";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function eliminarProducto($id){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="DELETE FROM productos WHERE id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarProductosxid($id){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT productos.id AS id_producto,
       categorias.nombre AS nombre_categoria,
       categorias.id as id_categoria,
       productos.nombre,
       productos.precio
FROM productos
JOIN categorias ON productos.id_categoria = categorias.id WHERE productos.id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function editarProducto(productos $productos, $id){
        $nombre=$productos->obtenernombre();
        $descripcion=$productos->obtenerdescripcion();
        $precio=$productos->obtenerprecio();
        $talla=$productos->obtenertalla();
        $categoria=$productos->obtenercategoria();
        $file=$productos->obtenerimagen();
        $conexion=new conexion;
        $conexion->abrir();
        $sql="UPDATE productos SET nombre='$nombre', precio='$precio', imagen='$file', id_categoria='$categoria' WHERE id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarProductosTotales(){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT productos.id AS id_producto,
       categorias.nombre AS nombre_categoria,
       categorias.id as id_categoria,
       productos.nombre,
       productos.precio
        FROM productos
        JOIN categorias ON productos.id_categoria = categorias.id ";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function editarProductoSinFoto(productos $productos, $id){
        $nombre=$productos->obtenernombre();
        $descripcion=$productos->obtenerdescripcion();
        $precio=$productos->obtenerprecio();
        $talla=$productos->obtenertalla();
        $categoria=$productos->obtenercategoria();
        $conexion=new conexion;
        $conexion->abrir();
        $sql="UPDATE productos SET nombre='$nombre', precio='$precio', id_categoria='$categoria' WHERE id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarPedidos(){
                $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT 
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
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarProductosCategoria($categoria){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT productos.id AS id_producto,
       categorias.nombre AS nombre_categoria,
       categorias.id as id_categoria,
       productos.nombre,
       productos.precio
        FROM productos
        JOIN categorias ON productos.id_categoria = categorias.id WHERE categorias.id='$categoria'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function consultarImagen($id){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT imagen FROM productos WHERE id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerUnaFila();
        $conexion->cerrar();
        return $result;
    }
}