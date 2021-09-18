<?php
/*
 Entidad: servidor
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class servidorDAO extends conexion{
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    function getById(int $id_servidor){
        $query = sprintf("SELECT * FROM servidor WHERE id_servidor='%d'",$id_servidor);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getbyId() en servidorDAO");
        }
    }

    function getCount(string $txt_busqueda=''){
        $sqlBusqueda = '';

        if ($txt_busqueda != ''){
            $sqlBusqueda = sprintf('AND (ip like "%%%1$s%%" or tipo like "%%%1$s%%" or estado  like "%%%1$s%%" or periodicidad_pago  like "%%%1$s%%" or nombre  like "%%%1$s%%" or fecha_creacion  like "%%%1$s%%" or observacion  like "%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf('SELECT count(*) as cantidad FROM servidor where 1=1 %s',$sqlBusqueda);
        $result = $this->getConexion()->query($query);

        if($result){
            $obj = $result->fetch_object();
            return $obj->cantidad;
        }else{
            throw new Exception("Error al intentar getCount() en servidorDAO");
        }
    }

    function getAllPage(string $txt_busqueda='', int $inicio=0, $muestra=10){
        $sqlBusqueda='';

        if ($txt_busqueda != ''){
            $sqlBusqueda = sprintf('AND(ip like "%%%1$s%%" or tipo like "%%%1$s%%" or estado  like "%%%1$s%%" or periodicidad_pago  like "%%%1$s%%" or nombre  like "%%%1$s%%" or fecha_creacion  like "%%%1$s%%" or observacion  like "%%%1$s%%")', $txt_busqueda);
        }

        $query = sprintf('SELECT * FROM servidor where 1=1 %s ORDER BY estado, tipo LIMIT %d, %d',$sqlBusqueda, $inicio, $muestra);
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAllPage() en servidor_detalleDAO");
        }
    }

    function insert(servidorDTO $servidorDTO){
        $query = sprintf('INSERT INTO servidor (id_servidor_detalle, ip, tipo, estado, periodicidad_pago, nombre, observacion) VALUES ("%d","%s","%s","%s","%s","%s","%s")', $servidorDTO->getId_servidor_detalle(), $servidorDTO->getIp(), $servidorDTO->GetTipo(), $servidorDTO->GetEstado(), $servidorDTO->getPeriodicidad_pago(), $servidorDTO->getNombre(), $servidorDTO->getObservacion());

        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en servidor_detalleDAO");
        }
    }

}

?>