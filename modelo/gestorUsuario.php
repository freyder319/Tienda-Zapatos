<?php 
class GestorUsuario{
    public function validarCorreo($correo){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT correo FROM usuarios WHERE correo='$correo'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function validarClave($correo,$contrasenia){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT contrasena FROM usuarios WHERE correo='$correo'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerUnaFila();
        $conexion->cerrar();
        if($result&& isset($result["contrasena"])){
            if(password_verify($contrasenia,$result["contrasena"])){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }
    public function consultarDatos($correo){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT * FROM usuarios WHERE correo='$correo'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerUnaFila();
        $conexion->cerrar();
        return $result;
    }
    public function agregarUsuario($nombre,$correo,$contrasenia){
        $conexion=new conexion;
        $conexion->abrir();
        $contraseniaHash=password_hash($contrasenia,PASSWORD_DEFAULT);
        $sql="INSERT INTO usuarios VALUES (NULL,'$nombre','$correo','$contraseniaHash','cliente')";
        $conexion->consulta($sql);
        $result=$conexion->obtenerFilasAfectadas();
        $conexion->cerrar();
        return $result;
    }
    public function consultarIdUsuario($correo){
        $conexion=new conexion;
        $conexion->abrir();
        $sql="SELECT id FROM usuarios WHERE correo='$correo'";
        $conexion->consulta($sql);
        $result=$conexion->obtenerUnaFila();
        $conexion->cerrar();
        return $result["id"];
    }
}