<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class resellerDTO {
    private int $id_reseller;
    private string $nombre;
    private string $email;
    private string $celular;

    function __construct(int $id_reseller=0, string $nombre='', $email='', $celular=''){
        $this->id_reseller = $id_reseller;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->celular = $celular;
    }

    function getId_reseller(): int{ return $this->id_reseller;}
    function setId_reseller($id_reseller): void { $this->id_reseller = $id_reseller; }

    function getNombre(): string{ return $this->nombre; }
    function setNombre($nombre): void{ $this->nombre = $nombre;}

    function getEmail(): string{ return $this->email;}
    function setEmail($email): void{ $this->email = $email;}

    function getCelular(): string{ return $this->celular;}
    function setCelular($celular): void{ $this->celular = $celular; }

    function map($obj){
        $this->setId_reseller($obj->id_reseller);
        $this->setNombre($obj->nombre);
        $this->setEmail($obj->email);
        $this->setCelular($obj->celular);
    }

    function loadById(int $id_reseller,mysqli $conexion){
        $resellerDAO = new resellerDAO($conexion);
        $obj = $resellerDAO->getById($id_reseller);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}
?>