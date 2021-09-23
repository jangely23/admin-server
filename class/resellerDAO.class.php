<?php
/*
 Entidad: reseller
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/
class resellerDAO extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function getById(int $id_reseller){
        $query = sprintf("SELECT * FROM reseller WHERE id_reseller = '%d'", $id_reseller);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById() en resellerDAO");
        }
    }

    function getAll(string $txt_busqueda=''){
        $sqlBusqueda = '';
        
        if($txt_busqueda != ''){
            $sqlBusqueda = sprintf('and (nombre like "%%%1$s%%" or email like "%%%1$s%%" or celular like "%%%1$s%%")',$txt_busqueda);
        }
        
        $query=sprintf("select * from reseller where 1=1 %s order by nombre asc",$sqlBusqueda);
        
        $result=$this->getConexion()->query($query);
        
        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAlld() en resellerDAO");
        }
    }

    function insert(resellerDTO $resellerDTO){
        $query = sprintf("INSERT INTO reseller (nombre, email, celular) values ('%s','%s','%s')", $resellerDTO->getNombre(), $resellerDTO->getEmail(), $resellerDTO->getCelular());
        var_dump($query);
        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en resellerDAO");
        }
    }

    function update(resellerDTO $resellerDTO){
        $query = sprintf("UPDATE reseller SET nombre='%s', email='%s', celular='%s' WHERE id_reseller='%d'", $resellerDTO->getNombre(), $resellerDTO->getEmail(), $resellerDTO->getCelular(), $resellerDTO->getId_reseller());

        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar insert() en resellerDAO");
        }
    }

    function delete(int $id_reseller){
        $query = sprintf("DELETE FROM reseller WHERE id_reseller = %d", $id_reseller);
        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar delete() en resellerDAO");
        }
    }
}
?>