<?php 
class Pedido{
    private $idPedido;
    private $idProducto;
    private $idUsuario;
    private $fecha;
    private $estado;

    public function __construct($idPedido, $idProducto, $idUsuario, $fecha, $estado) {
        $this->idPedido = $idPedido;
        $this->idProducto = $idProducto;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
        $this->estado = $estado;
    }

    public function obtenerIdPedido() {
        return $this->idPedido;
    }
    public function obtenerIdProducto() {
        return $this->idProducto;
    }

    public function obtenerIdUsuario() {
        return $this->idUsuario;
    }

    public function obtenerFecha() {
        return $this->fecha;
    }
        public function obtenerEstado() {
        return $this->estado;
    }
}