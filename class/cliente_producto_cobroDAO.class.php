<?php
/*
 Entidad: cuenta_producto_cobro
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_cobroDAO extends conexion{
    function __construct($conexion)  {
        parent::__construct($conexion);
    }

    function getById(int $id_cliente_producto_cobro){
        $query = sprintf("SELECT * FROM cliente_producto_cobro WHERE id_cliente_producto_cobro=%d", $id_cliente_producto_cobro);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("error al intentar getById() en cliente_producto_cobroDAO");
        }
    }

    function getAcountEnd(){
        $query = "SELECT * FROM cliente_producto_cobro ORDER BY numero_cuenta DESC LIMIT 1";
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("error al intentar getAcountEnd() en cliente_producto_cobroDAO");
        }
    }

    function getCount(string $txt_busqueda = ''){
        $sql_busqueda='';

        if($txt_busqueda != ''){
            $sql_busqueda = sprintf('AND (cuenta_cobro LIKE "%%%%1$s%%" or numero_cuenta LIKE "%%%%1$d%%" or estado LIKE "%%%%1$s%%" or observacion LIKE "%%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf("SELECT count(*) as cantidad FROM cliente_producto_cobro WHERE 1=1 %s", $sql_busqueda);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result->cantidad;
        }else{
            throw new Exception("error al intentar getCount() en cliente_producto_cobroDAO");
        }
    }

    function getAllPage(string $txt_busqueda = '',int $inicio, $muestra){
        $sql_busqueda='';

        if($txt_busqueda != ''){
            $sql_busqueda = sprintf('AND (cuenta_cobro LIKE "%%%%1$s%%" or numero_cuenta LIKE "%%%%1$d%%" or estado LIKE "%%%%1$s%%" or observacion LIKE "%%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf("SELECT * FROM cliente_producto_cobro WHERE 1=1 %s ORDER BY fecha_corte, estado LIMIT %d, %d", $sql_busqueda, $inicio, $muestra);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("error al intentar getAllPage() en cliente_producto_cobroDAO");
        }
    }

    function insert(cliente_producto_cobroDTO $cliente_producto_cobroDTO){
        $query = sprintf("INSERT INTO cliente_producto_cobro (id_cliente_producto, cuenta_cobro, numero_cuenta, estado, observacion, valor) values (%d, '%s', %d, '%s', '%s', %f)", $cliente_producto_cobroDTO->getId_cliente_producto(), $cliente_producto_cobroDTO->getCuenta_cobro(), $cliente_producto_cobroDTO->getNumero_cuenta(),$cliente_producto_cobroDTO->getEstado(), $cliente_producto_cobroDTO->getObservacion(), $cliente_producto_cobroDTO->getValor());
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("error al intentar insert() en cliente_producto_cobroDAO");
        }
    }

    function update(cliente_producto_cobroDTO $cliente_producto_cobroDTO){
        $query = sprintf("UPDATE cliente_producto_cobro SET id_cliente_producto=%d, cuenta_cobro='%s', numero_cuenta=%d, estado='%s', observacion='%s', valor=%f WHERE id_cliente_producto_cobro=%d", $cliente_producto_cobroDTO->getId_cliente_producto(), $cliente_producto_cobroDTO->getCuenta_cobro(), $cliente_producto_cobroDTO->getNumero_cuenta(),$cliente_producto_cobroDTO->getEstado(), $cliente_producto_cobroDTO->getObservacion(), $cliente_producto_cobroDTO->getValor(), $cliente_producto_cobroDTO->getId_cliente_producto_cobro());
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("error al intentar update() en cliente_producto_cobroDAO");
        }
    }

    function delete(int $id_cliente_producto_cobro){
        $query = sprintf("DELETE FROM cliente_producto_cobro WHERE id_cliente_producto_cobro=%d", $id_cliente_producto_cobro);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("error al intentar delete() en cliente_producto_cobroDAO");
        }
    }
}

?>