<?php

class moduloDTO{
    private int $id_modulo;
    private string $nombre;
    private string $proveedor;

    function __construct(int $id_modulo=0, string $nombre='', $proveedor='') {
        $this->id_modulo = $id_modulo;
        $this->nombre = $nombre;
        $this->proveedor = $proveedor;
    }

    function getId_modulo(): int { return $this->id_modulo; }
    function setId_modulo($id_modulo): void { $this->id_modulo = $id_modulo; }

    function getNombre(): string {return $this->nombre; }
    function setNombre($nombre): void { $this->nombre = $nombre;}

    function getProveedor(): string { return $this->proveedor;}
    function setProveedor($proveedor): void { $this->proveedor = $proveedor;}

    function map($obj){
        $this->setId_modulo($obj->id_modulo);
        $this->setNombre($obj->nombre);
        $this->setProveedor($obj->proveedor);
    }

    function loadById(int $id_modulo, mysqli $conexion){
        $moduloDAO = new moduloDAO($conexion);
        $obj = $moduloDAO->getById($id_modulo);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}
?>