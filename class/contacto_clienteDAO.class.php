<?php
/*
 Entidad: contacto_cliente
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class contacto_clienteDAO extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function getById(int $id_contacto_cliente){
        $query = sprintf("SELECT * FROM contacto_cliente WHERE id_contacto_cliente = '%d'", $id_contacto_cliente);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById en contacto_clienteDAO");
        }
    }

    function getCount(int $id_cliente){
        $query = sprintf("SELECT count(*) AS cantidad FROM contacto_cliente WHERE id_cliente = '%d'", $id_cliente);
        $result = $this->getConexion()->query($query);

        if($result){
            $obj = $result->fetch_object();
            return $obj->cantidad;
        }else{
            throw new Exception("Error al intentar getById en contacto_clienteDAO");
        }
    }    

    function getAllPage(int $id_cliente=0, $inicio = 0, $muestra = 10): mysqli_result{
        $query = sprintf("SELECT * FROM contacto_cliente WHERE id_cliente=%d limit %d, %d",$id_cliente, $inicio, $muestra);
        $result = $this->getConexion()->query($query);
        
        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAll en contacto_clienteDAO");
        }
    }

    function insert(contacto_clienteDTO $contacto_clienteDTO){
        $query = sprintf("INSERT INTO contacto_cliente (id_cliente, telefono, celular,email,otro) VALUES ('%d','%s','%s','%s','%s')", $contacto_clienteDTO->getIdCliente(), $contacto_clienteDTO->getTelefono(), $contacto_clienteDTO->getCelular(),$contacto_clienteDTO->getEmail(),$contacto_clienteDTO->getOtro());
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert en contacto_clienteDAO");
        }
    }

    function update(contacto_clienteDTO $contacto_clienteDTO){
        $query = sprintf("UPDATE contacto_cliente SET id_cliente='%d', telefono='%s', celular='%s', email='%s', otro='%s' WHERE id_contacto_cliente='%s'", $contacto_clienteDTO->getIdCliente(), $contacto_clienteDTO->getTelefono(), $contacto_clienteDTO->getCelular(),$contacto_clienteDTO->getEmail(),$contacto_clienteDTO->getOtro(), $contacto_clienteDTO->getIdContactoCliente());
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar update en contacto_clienteDAO");
        }
    }

    function deleteByCustomer(int $id_cliente){
        $query = sprintf('DELETE FROM contacto_cliente WHERE id_cliente="%d"', $id_cliente);
        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar deleteByCustomer() en contacto_clienteDAO");
        }
    }

    function delete(int $id_contacto_cliente){
        $query = sprintf('DELETE FROM contacto_cliente WHERE id_contacto_cliente="%d"', $id_contacto_cliente);
        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar delete() en contacto_clienteDAO");
        }
    }


}

?>