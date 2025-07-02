<?php

class Productos {
    private $nombre;
    private $descripcion;
    private $precio;
    private $talla;
    private $categoria;
    private $file;
    
    public function __construct($nombre, $descripcion, $precio,$talla, $categoria, $file)
    {
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
        $this->precio=$precio;
        $this->file=$file;
        $this->categoria=$categoria;
        $this->talla=$talla;
        
    }
    public function obtenernombre(){
        return $this->nombre;
    }
    public function obtenerdescripcion(){
        return $this->descripcion;
    }
    public function obtenerprecio(){
        return $this->precio;
    }
    public function obtenercategoria(){
        return $this->categoria;
    }
    public function obtenerimagen(){
        return $this->file;
    }
    public function obtenertalla(){
        return $this->talla;
    }
}

?>