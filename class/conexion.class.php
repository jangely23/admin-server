<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class conexion{
    private mysqli $conexion;

    function __construct(mysqli $conexion){
        $this->conexion = $conexion;
    }

    function getConexion(): mysqli{
        return $this->conexion;
    }

    function setConexion(mysqli $conexion): void{
        $this->conexion = $conexion;
    }

}


?>