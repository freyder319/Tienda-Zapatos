<?php

class Productos {
    private $nombre;
    private $especificacion;
    private $precio;
    private $marca;
    private $modelo;
    private $tipo;
    
    public function __construct($nombre, $especificacion, $precio,$marca,$modelo,$tipo)
    {
        $this->nombre=$nombre;
        $this->especificacion=$especificacion;
        $this->precio=$precio;
        $this->marca=$marca;
        $this->modelo=$modelo;
        $this->tipo=$tipo;
        
    }
    public function obtenernombre(){
        return $this->nombre;
    }
    public function obtenerEspecificacion(){
        return $this->especificacion;
    }
    public function obtenerprecio(){
        return $this->precio;
    }
    public function obtenertipo(){
        return $this->tipo;
    }
    public function obtenerModelo(){
        return $this->modelo;
    }
    public function obtenerMarca(){
        return $this->marca;
    }
}
?>