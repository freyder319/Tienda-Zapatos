<?php 
class Pedido{
    private $idPedido;
    private $idUsuario;
    private $fecha;
    private $estado;
    private $total;
    public function __construct($idPedido, $idUsuario, $fecha, $estado, $total) {
        $this->idPedido = $idPedido;
        $this->idUsuario = $idUsuario;
        $this->fecha = $fecha;
        $this->estado = $estado;
        $this->total = $total;
    }

    public function obtenerIdPedido() {
        return $this->idPedido;
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
    public function obtenerTotal() {
        return $this->total;
    }
}