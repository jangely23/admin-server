<?php 
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class usuarioDTO {
    private int $id_usuario;
    private string $nombre;
    private string $email;
    private string $usuario;
    private string $clave;
    private string $estado;

    function __construct(int $id_usuario=0,string $nombre='', $email='', $usuario='', $clave='', $estado=''){
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->estado = $estado;
    }


    function getId_usuario(): int { return $this->id_usuario; }
    function setId_usuario(int $id_usuario): void { $this->id_usuario = $id_usuario;}

    function getNombre(): string { return $this->nombre; }
    function setNombre(string $nombre): void { $this->nombre = $nombre; }

    function getEmail(): string { return $this->email; }
    function setEmail(string $email) : void { $this->email = $email; }

    function getUsuario(): string { return $this->usuario; }
    function setUsuario(string $usuario): void { $this->usuario = $usuario; }

    function getClave() : string { return $this->clave; }
    function setClave($clave) : void { $this->clave = $clave; }

    function getEstado() : string { return $this->estado; }
    function setEstado(string $estado): void { $this->estado = $estado; }

    function map($obj){
        $this->setId_usuario($obj->id_usuario);
        $this->setNombre($obj->nombre);
        $this->setEmail($obj->email);
        $this->setUsuario($obj->usuario);
        $this->setClave($obj->clave);
        $this->setEstado($obj->estado);
    }
    
    function loadById(int $id_usuario, mysqli $conexion){
        $usuarioDAO = new usuarioDAO($conexion);
        $obj = $usuarioDAO->getById($id_usuario);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }

    function loadByEmailAndClave(string $email, string $clave,mysqli $conexion){
        $uDAO=new usuarioDAO($conexion);       
        $obj=$uDAO->getByEmailAndClave($email, $clave);
        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}

?>