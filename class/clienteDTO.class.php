<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class clienteDTO{
    private int $id_cliente;
    private string $nombre;
    private string $cc_nit;
    private string $administrador;
    private string $direccion;
    private string $ciudad;
    private string $pais;
    private string $estado;
    
    function __construct(int $id_cliente=0,string $nombre='',string $cc_nit='',string $administrador='',string $direccion='',string $ciudad='',string $pais='',string $estado=''){
        $this->id_cliente = $id_cliente;
        $this->nombre = $nombre;
        $this->cc_nit = $cc_nit;
        $this->administrador = $administrador;
        $this->direccion = $direccion;
        $this->ciudad = $ciudad;
        $this->pais = $pais;
        $this->estado = $estado;
    }

    public function getIdCliente(): int { return $this->id_cliente; }
    public function setIdCliente(int $id_cliente): void { $this->id_cliente = $id_cliente; }

    public function getNombre(): string { return $this->nombre; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }

    public function getCcNit(): string { return $this->cc_nit; }
    public function setCcNit(string $cc_nit): void { $this->cc_nit = $cc_nit; }

    public function getAdministrador(): string { return $this->administrador; }
    public function setAdministrador(string $administrador): void { $this->administrador = $administrador; }

    public function getDireccion(): string { return $this->direccion; }
    public function setDireccion(string $direccion): void { $this->direccion = $direccion; }

    public function getCiudad(): string { return $this->ciudad; }
    public function setCiudad(string $ciudad): void { $this->ciudad = $ciudad; }

    public function getPais(): string { return $this->pais; }
    public function setPais(string $pais): void { $this->pais = $pais; }

    public function getEstado(): string { return $this->estado; }
    public function setEstado(string $estado): void { $this->estado = $estado; }

    function map($obj){
        $this->setIdCliente($obj->id_cliente);
        $this->setNombre($obj->nombre);
        $this->setCcNit($obj->cc_nit);
        $this->setAdministrador($obj->administrador);
        $this->setDireccion($obj->direccion);
        $this->setCiudad($obj->ciudad);
        $this->setPais($obj->pais);
        $this->setEstado($obj->estado);
    }

    function loadById(int $id_cliente, mysqli $conexion){
        $clienteDAO = new clienteDAO($conexion);
        $obj = $clienteDAO->getById($id_cliente);
        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }    
}

?>