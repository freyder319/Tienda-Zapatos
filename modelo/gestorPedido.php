<?php

class GestorPedido
{
    public function guardarPedido($pedido)
    {
        $idUsuario = $pedido->obtenerIdUsuario();
        $fecha = $pedido->obtenerFecha();
        $total = $pedido->obtenerTotal();
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "INSERT INTO pedidos VALUES (NULL, '$idUsuario', '$fecha','Pendiente', '$total')";
        $conexion->consulta($sql);
        $result = $conexion->obtenerUltimoIdInsertado();
        $conexion->cerrar();
        return $result;
    }
    public function guardarDetallePedido(DetallePedido $detallePedido)
    {
        $idPedido = $detallePedido->obtenerIdPedido();
        $idProducto = $detallePedido->obtenerIdProducto();
        $cantidad = $detallePedido->obtenerCantidad();
        $precio = $detallePedido->obtenerPrecio();

        $subtotal = $cantidad * $precio;
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "INSERT INTO detalle_pedido VALUES (NULL, '$idPedido', '$idProducto', '$cantidad', '$precio', '$subtotal')";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function actualizarEstadoPedido($id, $estado)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "UPDATE pedidos SET estado='$estado' WHERE id='$id'";
        $conexion->consulta($sql);
        $result = $conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarPedidosCliente($id)
    {
        $conexion = new conexion;
        $conexion->abrir();
        $sql = "SELECT 
        p.id AS pedido_id,
        u.nombre AS nombre_usuario,
        p.fecha,
        p.estado,
        p.total
        FROM pedidos p
        INNER JOIN usuarios u ON p.id_usuario = u.id
        WHERE u.id='$id';";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
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
        p.fecha,
        p.estado,
        p.total
        FROM pedidos p
        INNER JOIN usuarios u ON p.id_usuario = u.id";
        $conexion->consulta($sql);
        $result = $conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
}