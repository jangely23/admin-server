<?php

require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/cliente_productoDAO.class.php';
require '../class/cliente_productoDTO.class.php';
require '../class/clienteDAO.class.php';
require '../class/clienteDTO.class.php';
require "../class/servidorDTO.class.php";
require "../class/servidorDAO.class.php";
require "../class/resellerDAO.class.php";
require "../class/resellerDTO.class.php";
require "../class/productoDAO.class.php";
require "../class/productoDTO.class.php";

$cliente_productoDAO = new cliente_productoDAO($conexion);
$cliente_productoDTO = new cliente_productoDTO();

$clienteDAO = new clienteDAO($conexion);
$servidorDAO = new servidorDAO($conexion);
$resellerDAO = new resellerDAO($conexion);
$productoDAO = new productoDAO($conexion);

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??"";

$clientes = $clienteDAO->getAll();
$servidores = $servidorDAO->getAll();
$reselleres = $resellerDAO->getAll();
$productos = $productoDAO->getAllActive();

?>