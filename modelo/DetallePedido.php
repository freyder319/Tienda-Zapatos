<?php
Class DetallePedido{
    private $idDetallePedido;
    private $idPedido;
    private $idProducto;
    private $cantidad;
    private $precio;
    private $subtotal;

    public function __construct($idPedido, $idProducto, $cantidad, $precio, $subtotal) {
        $this->idPedido = $idPedido;
        $this->idProducto = $idProducto;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
        $this->subtotal = $subtotal;
    }

    public function obtenerIdPedido() {
        return $this->idPedido;
    }

    public function obtenerIdProducto() {
        return $this->idProducto;
    }

    public function obtenerCantidad() {
        return $this->cantidad;
    }

    public function obtenerPrecio() {
        return $this->precio;
    }
    
    public function obtenerSubtotal() {
        return $this->subtotal;
    }
}