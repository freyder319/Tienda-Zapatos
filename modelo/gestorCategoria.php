<?php

class Categoria{
    public function guardarCategoria($categoria){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="INSERT INTO categorias VALUES (NULL,'$categoria')";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function eliminarCategoria($id){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="DELETE FROM categorias WHERE id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarCategoriaxid($id){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT * FROM categorias WHERE id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerResultado();
        $conexion->cerrar();
        return $result;
    }
    public function editarCategoria($id,$nombre){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="UPDATE categorias SET nombre='$nombre' WHERE id='$id'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
}