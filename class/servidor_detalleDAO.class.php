<?php
/*
 Entidad: servidor_detalle
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class servidor_detalleDAO extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion); 

    }

    function getById(int $id_servidor_detalle){
        $query = sprintf("SELECT * FROM servidor_detalle WHERE id_servidor_detalle = %d", $id_servidor_detalle);
        
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById en servidor_detalleDAO");
        }
    }

    function getCount(string $txt_busqueda=''){
        $sqlBusqueda = '';

        if($txt_busqueda != ''){
            $sqlBusqueda = sprintf('AND (plan_servidor LIKE "%%%1$s%%" or ram LIKE "%%%1$s%%" or disco LIKE "%%%1$s%%" or procesador LIKE "%%%1$s%%" or datacentar LIKE "%%%1$s%%" or raid LIKE "%%%1$s%%" or costo LIKE "%%%1$f%%" or moneda LIKE "%%%1$s%%")',$txt_busqueda);
        }

        $query = sprintf("SELECT count(*) AS cantidad FROM servidor_detalle WHERE 1=1 %s",$sqlBusqueda);
        $result = $this->getConexion()->query($query);

        
        if($result){
            $obj = $result->fetch_object();
            return $obj->cantidad;
        }else{
            throw new Exception("Error al intentar getCount() en servidor_detalleDAO");
        }
    }


    function getAll(string $txt_busqueda=''){

        if($txt_busqueda != ''){
            $sqlBusqueda = sprintf('AND (plan_servidor LIKE "%%%1$s%%" or ram LIKE "%%%1$s%%" or disco LIKE "%%%1$s%%" or procesador LIKE "%%%1$s%%" or datacentar LIKE "%%%1$s%%" or raid LIKE "%%%1$s%%" or costo LIKE "%%%1$f%%" or moneda LIKE "%%%1$s%%")',$txt_busqueda);
        }

        $query = sprintf("SELECT * FROM servidor_detalle WHERE 1=1 %s ORDER BY costo, plan_servidor asc ",$sqlBusqueda);
        $result = $this->getConexion()->query($query);
        
        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAllPage() en servidor_detalleDAO");
        }
    }

    function getAllPage(string $txt_busqueda='', $inicio=0, $muestra = 10){
        $sqlBusqueda = '';

        if($txt_busqueda != ''){
            $sqlBusqueda = sprintf('AND (plan_servidor LIKE "%%%1$s%%" or ram LIKE "%%%1$s%%" or disco LIKE "%%%1$s%%" or procesador LIKE "%%%1$s%%" or datacentar LIKE "%%%1$s%%" or raid LIKE "%%%1$s%%" or costo LIKE "%%%1$f%%" or moneda LIKE "%%%1$s%%")',$txt_busqueda);
        }

        $query = sprintf("SELECT * FROM servidor_detalle WHERE 1=1 %s ORDER BY costo, plan_servidor asc LIMIT %d, %d",$sqlBusqueda, $inicio, $muestra);
        $result = $this->getConexion()->query($query);
        
        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAllPage() en servidor_detalleDAO");
        }
    }

    function insert(servidor_detalleDTO $servidor_detalleDTO){
        $query = sprintf('INSERT INTO servidor_detalle (plan_servidor, ram, disco, procesador, datacentar, raid, costo, moneda) VALUES ("%s", "%s", "%s", "%s", "%s", "%s", "%f", "%s")',$servidor_detalleDTO->getPlan_servidor(), $servidor_detalleDTO->getRam(), $servidor_detalleDTO->getDisco(),$servidor_detalleDTO->getProcesador(), $servidor_detalleDTO->getDatacenter(), $servidor_detalleDTO->getRaid(),$servidor_detalleDTO->getCosto(), $servidor_detalleDTO->getMoneda());
       
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en servidor_detalleDAO");
        }
    }

    function update(servidor_detalleDTO $servidor_detalleDTO){
        $query = sprintf('UPDATE servidor_detalle SET plan_servidor="%s", ram="%s", disco="%s", procesador="%s", datacentar="%s", raid="%s", costo="%f", moneda="%s" WHERE id_servidor_detalle="%d"',$servidor_detalleDTO->getPlan_servidor(), $servidor_detalleDTO->getRam(), $servidor_detalleDTO->getDisco(),$servidor_detalleDTO->getProcesador(), $servidor_detalleDTO->getDatacenter(), $servidor_detalleDTO->getRaid(),$servidor_detalleDTO->getCosto(), $servidor_detalleDTO->getMoneda(), $servidor_detalleDTO->getId_servidor_detalle());
        var_dump($query);
        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar update() en servidor_detalleDAO");
        }
    }

    function delete(int $id_servidor_detalle){
        $query = sprintf("DELETE FROM servidor_detalle WHERE id_servidor_detalle = %d", $id_servidor_detalle);
        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar delete() en servidor_detalleDAO");
        }
    }
}

?>