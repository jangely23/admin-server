<?php
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/usuarioDTO.class.php";
require "../class/usuarioDAO.class.php";

$usuarioDTO = new usuarioDTO();
$usuarioDAO = new usuarioDAO($conexion);

$usuarios = $usuarioDAO->getAll
?>