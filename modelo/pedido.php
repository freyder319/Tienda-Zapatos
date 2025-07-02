<?php 
class Pedido{
    private $idProducto;
    private $idUsuario;
    private $cantidad;
    private $fecha;

    public function __construct($idProducto, $idUsuario, $cantidad, $fecha) {
        $this->idProducto = $idProducto;
        $this->idUsuario = $idUsuario;
        $this->cantidad = $cantidad;
        $this->fecha = $fecha;
    }

    public function obtenerIdProducto() {
        return $this->idProducto;
    }

    public function obtenerIdUsuario() {
        return $this->idUsuario;
    }

    public function obtenerCantidad() {
        return $this->cantidad;
    }

    public function obtenerFecha() {
        return $this->fecha;
    }
}