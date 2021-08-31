<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
 Type = "MYSQL"
 HTTP = "true"
*/

$hostname_conexion = "localhost";
$database_conexion = "serverdb";
$username_conexion = "administrador";
$passwors_conexion = "proyectoServer";

$conexion = mysqli_connect($hostname_conexion,$username_conexion,$passwors_conexion,$database_conexion) or trigger_error("Error en consulta", E_USER_ERROR);
?>