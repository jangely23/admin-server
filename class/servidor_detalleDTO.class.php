<?php 
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class servidor_detalleDTO{
    private int $id_servidor_detalle;
    private string $plan_servidor;
    private string $ram;
    private string $disco;
    private string $procesador;
    private string $datacenter;
    private string $raid;
    private float $costo;
    private string $moneda;

    function __construct(int $id_servidor_detalle=0, string $plan_servidor="",string $ram="",string $disco="",string $procesador="",string $datacenter="",string $raid="", float $costo=0, string $moneda=''){
        $this->id_servidor_detalle = $id_servidor_detalle;
        $this->plan_servidor = $plan_servidor;
        $this->ram = $ram;
        $this->disco = $disco;
        $this->procesador = $procesador;
        $this->datacenter = $datacenter;
        $this->raid = $raid;
        $this->costo = $costo;
        $this->moneda = $moneda;
    }

    function getId_servidor_detalle(): int { return $this->id_servidor_detalle;}
    function setId_servidor_detalle($id_servidor_detalle): void { $this->id_servidor_detalle= $id_servidor_detalle;}

    function getPlan_servidor(): string { return $this->plan_servidor;}
    function setPlan_servidor($plan_servidor): void { $this->plan_servidor = $plan_servidor;}

    function getRam(): string { return $this->ram;}
    function setRam($ram): void { $this->ram = $ram;}

    function getDisco(): string { return $this->disco;}
    function setDisco($disco): void { $this->disco = $disco;}

    function getProcesador(): string { return $this->procesador;}
    function setProcesador($procesador): void { $this->procesador = $procesador;}

    function getDatacenter(): string { return $this->datacenter;}
    function setDatacenter($datacenter): void { $this->datacenter = $datacenter;}

    function getRaid(): string { return $this->raid;}
    function setRaid($raid): void { $this->raid = $raid;}

    function getCosto(): float { return $this->costo; }
    function setCosto($costo): void { $this->costo = $costo;}

    function getMoneda(): string { return $this->moneda;}
    function setMoneda($moneda): void { $this->moneda = $moneda;}

    function map($obj){
        $this->setId_servidor_detalle($obj->id_servidor_detalle);
        $this->setPlan_servidor($obj->plan_servidor);
        $this->setRam($obj->ram);
        $this->setDisco($obj->disco);
        $this->setProcesador($obj->procesador);
        $this->setDatacenter($obj->datacentar);
        $this->setRaid($obj->raid);
        $this->setCosto($obj->costo);
        $this->setMoneda($obj->moneda);
    }

    function loadById(int $id_servidor_detalle, mysqli $conexion){
        $servidor_detalleDAO = new servidor_detalleDAO($conexion);
        $obj = $servidor_detalleDAO->getById($id_servidor_detalle);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}

?>
