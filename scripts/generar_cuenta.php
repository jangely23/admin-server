<?php
include "../config/conexion.php";
include "../class/conexion.class.php";
include "../class/cliente_producto_cobroDAO.class.php";
include "../class/cliente_producto_cobroDTO.class.php";
include "../class/cliente_productoDAO.class.php";
include "../class/cliente_productoDTO.class.php";
include "../class/clienteDAO.class.php";
include "../class/clienteDTO.class.php";
include "../class/servidorDAO.class.php";
include "../class/servidorDTO.class.php";

$cliente_productoDTO = new cliente_productoDTO();
$cliente_productoDAO = new cliente_productoDAO($conexion);

$clienteDTO = new clienteDTO();
$servidorDTO = new servidorDTO();
$cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);

$numero_cuenta = 0;
$nombre_cliente = "";
$ip_servidor = "";
$referencia = "";
$valor_pagar = 0;

//Establece fechas de facturacion para cuenta de cobro y obtiene los cliente_producto a cobrar
date_default_timezone_set('America/Bogota');
$x_minuto = 'no';
$fecha_actual = date('d-m-Y');

$inicio_corte = date("d-m-Y",strtotime($fecha_actual."+9 days"));
$fin_corte = date("d-m-Y",strtotime($inicio_corte."+1 months, -1 days"));

if(date('d',strtotime($fecha_actual))==16){ //validacion fechas de fcovoip y simple
    $fecha_pago = date("d-m-Y",strtotime($fecha_actual."+9 days"));
    $fecha_suspension = date("d-m-Y",strtotime($fecha_pago."+1 days"));

    $cliente_productos = $cliente_productoDAO->getAllByCheck($x_minuto);

}else if(date('d',strtotime($fecha_actual))==26){ //validacion fechas de paso x min
    $fecha_pago = date("t-m-Y", strtotime($fecha_actual));
    $fecha_suspension = date("d-m-Y",strtotime($fecha_pago."+1 days")); 
    $x_minuto = 'si';

    $cliente_producto = $cliente_productoDAO->getAllByCheck($x_minuto);
}


while($obj = $cliente_producto->fetch_object()){
    $cliente_productoDTO->map($obj);
    $clienteDTO->loadById($cliente_productoDTO->getId_cliente(), $conexion);
    $servidorDTO->loadById($cliente_productoDTO->getId_servidor(), $conexion);
    $cuenta_cobro = $cliente_producto_cobroDAO->getAcountEnd();

    $numero_cuenta = $cuenta_cobro->numero_cuenta + 1;
    $nombre_cliente = $clienteDTO->getNombre();
    $ip_servidor = $servidorDTO->getIp();
    $referencia = $cliente_productoDTO->getReferencia();
    $valor_pagar = $cliente_productoDTO->getReferencia();

}

?>