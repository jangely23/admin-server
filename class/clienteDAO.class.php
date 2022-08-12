<?php
/*
 Entidad: cliente
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class clienteDAO extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function getById(int $id_cliente){
        $query = sprintf("SELECT * FROM cliente WHERE id_cliente = '%d'", $id_cliente);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById en clienteDAO");
        }
    }

    function getCount(string $txt_busqueda=""){
        $sqlBusqueda='';

        if($txt_busqueda != ''){
            $sqlBusqueda = sprintf('and (nombre like "%%%1$s%%" or cc_nit like "%%%1$s%%" or administrador like "%%%1$s%%" or direccion like "%%%1$s%%" or ciudad like "%%%1$s%%" or pais like "%%%1$s%%" or estado like "%%%1$s%%")', $txt_busqueda);
        }

        $query=sprintf("SELECT count(*) AS cantidad FROM cliente WHERE 1=1 %s ORDER BY estado, nombre ASC", $sqlBusqueda);
        $result = $this->getConexion()->query($query);

        if($result){
            $obj = $result->fetch_object();
            return $obj->cantidad;
        }else{
            throw new Exception("Error al intentar getCount() en clienteDAO");
        }
    }

    function getAllPage(string $txt_busqueda="", int $inicio=0, int $muestra=10): mysqli_result{
        $sqlBusqueda = '';

        if($txt_busqueda != ''){
            $sqlBusqueda = sprintf('and (nombre like "%%%1$s%%" or cc_nit like "%%%1$s%%" or administrador like "%%%1$s%%" or direccion like "%%%1$s%%" or ciudad like "%%%1$s%%" or pais like "%%%1$s%%" or estado like "%%%1$s%%")',$txt_busqueda);
        }

        $query=sprintf('SELECT * FROM cliente WHERE 1=1 %s ORDER BY estado, nombre ASC LIMIT %d,%d', $sqlBusqueda,$inicio,$muestra); 

        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAllPage() en clienteDAO");
        }
    }

    //funcion exclusiva para uso en form de cliente_producto
    
    function getAll(): mysqli_result{

        $query='SELECT * FROM cliente ORDER BY estado, nombre ASC'; 

        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAll() en clienteDAO");
        }
    }
    
    function insert(clienteDTO $clienteDTO){
        $query = sprintf('INSERT INTO cliente (nombre, cc_nit, administrador, direccion, ciudad, pais, estado) VALUES ("%s","%s","%s","%s","%s","%s","%s")', $clienteDTO->getNombre(), $clienteDTO->getCcNit(), $clienteDTO->getAdministrador(), $clienteDTO->getDireccion(), $clienteDTO->getCiudad(), $clienteDTO->getPais(), $clienteDTO->getEstado());
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en clienteDAO");
        }
    }

    function update(clienteDTO $clienteDTO){
        $query = sprintf('UPDATE cliente SET nombre="%s", cc_nit="%s", administrador="%s", direccion="%s", ciudad="%s", pais="%s", estado="%s" WHERE id_cliente="%d"', $clienteDTO->getNombre(), $clienteDTO->getCcNit(), $clienteDTO->getAdministrador(), $clienteDTO->getDireccion(), $clienteDTO->getCiudad(), $clienteDTO->getPais(), $clienteDTO->getEstado(), $clienteDTO->getIdCliente());

        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar update() en clienteDAO");
        }
    }

    function delete(int $id_cliente){
        $query = sprintf('DELETE FROM cliente WHERE id_cliente="%d"', $id_cliente);
        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar delete() en clienteDAO");
        }
    }
}

?>