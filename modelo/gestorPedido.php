<?php

class gestorPedido{
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
}