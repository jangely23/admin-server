<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class servidorDTO{
    private int $id_servidor;
    private int $id_servidor_detalle;
    private string $ip;
    private string $tipo;
    private string $estado;
    private string $periodicidad_pago;
    private string $nombre;
    private string $observacion;

    function __construct(int $id_servidor=0, $id_servidor_detalle=0,string $ip='', $tipo='', $estado='', $periodicidad_pago='', $nombre='', $observacion='' ) {
        $this->id_servidor = $id_servidor;
        $this->id_servidor_detalle = $id_servidor_detalle;
        $this->ip = $ip;
        $this->tipo = $tipo;
        $this->estado = $estado;
        $this->periodicidad_pago = $periodicidad_pago;
        $this->nombre = $nombre;
        $this->observacion = $observacion;
    }

    function getId_servidor(): int{ return $this->id_servidor; }
    function setId_servidor($id_servidor): void{ $this->id_servidor=$id_servidor;}

    function getId_servidor_detalle(): int{ return $this->id_servidor_detalle; }
    function setId_servidor_detalle($id_servidor_detalle): void{ $this->id_servidor=$id_servidor_detalle;}
    
    function getIp(): string{ return $this->ip; }
    function setIp($ip): void{ $this->ip=$ip;}
    
    function getTipo(): string{ return $this->tipo; }
    function setTipo($tipo): void{ $this->tipo=$tipo;}
    
    function getEstado(): string{ return $this->estado; }
    function setEstado($estado): void{ $this->estado=$estado;}
    
    function getPeriodicidad_pago(): string{ return $this->periodicidad_pago; }
    function setPeriodicidad_pago($periodicidad_pago): void{ $this->periodicidad_pago=$periodicidad_pago;}
    
    function getNombre(): string{ return $this->nombre; }
    function setNombre($nombre): void{ $this->nombre=$nombre;}

    function getObservacion(): string{ return $this->observacion; }
    function setObservacion($observacion): void{ $this->observacion=$observacion;}

    function map($obj){
        $this->setId_servidor($obj->id_servidor);
        $this->setId_servidor_detalle($obj->id_servidor_detalle);
        $this->setIp($obj->ip);
        $this->setTipo($obj->tipo);
        $this->setEstado($obj->estado);
        $this->setPeriodicidad_pago($obj->periodicidad_pago);
        $this->setNombre($obj->nombre);
        $this->setObservacion($obj->observacion);
    }

    function loadById(int $id_servidor, mysqli $conexion){
        $servidorDAO = new servidorDAO($conexion);
        $obj = $servidorDAO->getById($id_servidor);
        
        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}


?>