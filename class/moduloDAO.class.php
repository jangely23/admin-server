<?php

class moduloDAO extends conexion{
    function __construct(mysqli $conexion)  {
        parent::__construct($conexion);
    }

    function getById(int $id_modulo){
        $query = sprintf("SELECT * FROM modulo WHERE id_modulo = '%d'", $id_modulo);
        $result = $this->getConexion()->query($query);

        if($result){
            if($result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Erro al intentar getById() en moduloDAO()");
        }
    }
}

?>