<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/
class productoDTO{
    private int $id_producto;
    private string $nombre;
    private string $version;
    private string $estado;

    function __construct(int $id_producto=0, string $nombre='', $version='', $estado=''){
        $this->id_producto = $id_producto;
        $this->nombre = $nombre;
        $this->version = $version;
        $this->estado = $estado;
    }

    function getId_producto(): int{return $this->id_producto;}
    function setId_producto($id_producto): void{ $this->id_producto = $id_producto; }

    function getNombre(): string{ return $this->nombre;}
    function setNombre($nombre): void{ $this->nombre = $nombre; }

    function getVersion(): string { return $this->version;}
    function setVersion($version): void { $this->version = $version;}

    function getEstado(): string{ return $this->estado;}
    function setEstado($estado): void { $this->estado = $estado;}

    function map($obj){
        $this->setId_producto($obj->id_producto);
        $this->setNombre($obj->nombre);
        $this->setVersion($obj->version);
        $this->setEstado($obj->estado);
    }

    function loadById(int $id_producto, mysqli $conexion){
        $productoDAO = new productoDAO($conexion);
        $obj = $productoDAO->getById($id_producto);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}
?>