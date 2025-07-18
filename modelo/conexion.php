<?php 
class Conexion{
    private $mySQLI;
    private $sql;
    private $result;
    private $filasAfectadas;
    private $id;
    public function abrir(){
        $this->mySQLI = new mysqli("localhost", "root", "", "tienda_tenis");
        if ($this->mySQLI->connect_error) {
            die("Error en la conexion: " . $this->mySQLI->connect_error);
        }
    }
    public function cerrar(){
            $this->mySQLI->close();
    }
    public function consulta($sql){
        $this->sql= $sql;
        $this->result = $this->mySQLI->query($sql);
        $this->filasAfectadas = $this->mySQLI->affected_rows;
        $this->id= $this->mySQLI->insert_id;
    }
    public function obtenerResultado(){
        return $this->result;
    }
    public function obtenerFilasAfectadas(){
        if ($this->result){
            return $this->filasAfectadas;
        }
        return 0;
    }
    public function obtenerUnaFila(){
        if ($this->result){
            return $this->result->fetch_assoc();
        }
        return null;
    }
    public function ObtenerId(){
        return $this->id;
    }
    public function obtenerUltimoIdInsertado() {
        return $this->mySQLI->insert_id;
    }
}