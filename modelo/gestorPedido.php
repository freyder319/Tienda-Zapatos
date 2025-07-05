<?php

class GestorPedido{
    public function guardarPedido($pedido){
        $idProducto = $pedido->obtenerIdProducto();
        $idUsuario = $pedido->obtenerIdUsuario();
        $cantidad = $pedido->obtenerCantidad();
        $fecha = $pedido->obtenerFecha();
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "INSERT INTO pedidos VALUES (NULL, '$idUsuario', '$idProducto', '$cantidad', '$fecha','Pendiente')";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function actualizarEstadoPedido($id, $estado){
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "UPDATE pedidos SET estado='$estado' WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarPedidosCliente($id){
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
}