<?php 
class Estadisticas
{
    public function unidadesVendidasPorCategoria(){
        $conexion = new Conexion;
        $conexion->abrir();
        $sql = "SELECT c.nombre AS categoria, SUM(dp.cantidad) AS unidades
                FROM   detalle_pedido dp
                JOIN   productos      p ON dp.id_producto  = p.id
                JOIN   categorias     c ON p.id_categoria = c.id
                GROUP  BY c.nombre
                ORDER  BY unidades DESC";
        $conexion->consulta($sql);
        $result= $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function topProductosVendidos(){
        $conexion = new Conexion;
        $conexion->abrir();
        $sql = "SELECT p.nombre AS producto, SUM(dp.cantidad) AS unidades
                         FROM   detalle_pedido dp
                         JOIN   productos p ON dp.id_producto = p.id
                         GROUP  BY p.nombre
                         ORDER  BY unidades DESC
                         LIMIT  10";
        $conexion->consulta($sql);
        $result= $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function ingresosPorCategoria(){
        $conexion = new Conexion;
        $conexion->abrir();
        $sql = "SELECT c.nombre AS categoria, SUM(dp.subtotal) AS ingresos
                FROM   detalle_pedido dp
                JOIN   productos      p ON dp.id_producto  = p.id
                JOIN   categorias     c ON p.id_categoria = c.id
                GROUP  BY c.nombre
                ORDER  BY ingresos DESC";
        $conexion->consulta($sql);
        $result= $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
}