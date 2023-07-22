<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
 Type = "MYSQL"
 HTTP = "true"
*/

$hostname_conexion = "127.0.0.1";
$database_conexion = "serverdb";
$username_conexion = "administrador";
$password_conexion = "theGoalDB2021*"; 

$conexion = mysqli_connect($hostname_conexion,$username_conexion,$password_conexion,$database_conexion) or trigger_error("Error en consulta", E_USER_ERROR);
?>
