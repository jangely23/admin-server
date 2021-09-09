<?php
/* 
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class contacto_clienteDTO{
    private int $id_contacto_cliente;
    private int $id_cliente;
    private string $telefono;
    private string $celular;
    private string $email;
    private string $otro;

    function __construct(int $id_contacto_cliente=0, int $id_cliente=0, string $telefono = "",string $celular = '', $email='',string $otro=''){
        $this->id_contacto_cliente = $id_contacto_cliente;
        $this->id_cliente = $id_cliente;
        $this->telefono = $telefono;
        $this->celular = $celular;
        $this->email = $email;
        $this->otro = $otro;
    }

    function getIdContactoCliente(): int { return $this->id_contacto_cliente; }
    function setIdContactoCliente(int $id_contacto_cliente): void { $this->id_contacto_cliente = $id_contacto_cliente;  }

    function getIdCliente(): int { return $this->id_cliente; }
    function setIdCliente(int $id_cliente): void { $this->id_cliente = $id_cliente;  }

    function getTelefono(): string { return $this->telefono; }
    function setTelefono(string $telefono): void { $this->telefono = $telefono;  }

    function getCelular(): string { return $this->celular; }
    function setCelular(string $celular): void { $this->celular = $celular;  }

    function getEmail(): string { return $this->email; }
    function setEmail(string $email): void { $this->email = $email;  }

    function getOtro(): string { return $this->otro; }
    function setOtro(string $otro): void { $this->otro = $otro; }

    function map($obj){
        $this->setIdContactoCliente($obj->id_contacto_cliente);
        $this->setIdCliente($obj->id_cliente);
        $this->setTelefono($obj->telefono);
        $this->setCelular($obj->celular);
        $this->setEmail($obj->email);
        $this->setOtro($obj->otro);
    }

    function loadById(int $id_contacto_cliente, mysqli $conexion){
        $contacto_clienteDAO = new contacto_clienteDAO($conexion);
        $obj = $contacto_clienteDAO->getById($id_contacto_cliente);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}


?>