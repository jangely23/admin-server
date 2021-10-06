<?php
header('Content-type: image/png'); 
include "../config/conexion.php";
include "../class/conexion.class.php";
include "../class/cliente_producto_cobroDAO.class.php";
include "../class/cliente_producto_cobroDTO.class.php";
include "../class/cliente_productoDAO.class.php";
include "../class/cliente_productoDTO.class.php";
require "../class/contacto_clienteDAO.class.php";
require "../class/contacto_clienteDTO.class.php";
include "../class/clienteDAO.class.php";
include "../class/clienteDTO.class.php";
include "../class/servidorDAO.class.php";
include "../class/servidorDTO.class.php";
include "./crear_cobro.php";
include "./enviar_email.php";

$cliente_productoDTO = new cliente_productoDTO();
$cliente_productoDAO = new cliente_productoDAO($conexion);

$clienteDTO = new clienteDTO();
$servidorDTO = new servidorDTO();
$cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);

$tipo_email_enviar = "cuenta_cobro";
$x_minuto = 0;
$fecha_actual = date('d-m-Y');

//Establece fechas de facturacion para cuenta de cobro y obtiene los cliente_producto a cobrar
date_default_timezone_set('America/Bogota');

$inicio_corte = date("d-m-Y",strtotime($fecha_actual."+9 days"));
$fin_corte = date("d-m-Y",strtotime($inicio_corte."+1 months, -1 days"));

if(date('d',strtotime($fecha_actual))==16){ //validacion fechas de fcovoip y simple
    $fecha_pago = date("d-m-Y",strtotime($fecha_actual."+9 days"));
    $fecha_suspension = date("d-m-Y",strtotime($fecha_pago."+1 days"));

    $cliente_productos = $cliente_productoDAO->getAllByCheck($x_minuto);

}else if(date('d',strtotime($fecha_actual))==06){ //validacion fechas de paso x min
    $fecha_pago = date("t-m-Y", strtotime($fecha_actual));
    $fecha_suspension = date("d-m-Y",strtotime($fecha_pago."+1 days")); 
    $x_minuto = 1;

    $cliente_productos = $cliente_productoDAO->getAllByCheck($x_minuto);
}

$fechas = array($fecha_actual, $inicio_corte, $fin_corte, $fecha_pago, $fecha_suspension);

while($obj = $cliente_productos->fetch_object()){
    $cliente_productoDTO->map($obj);
    $clienteDTO->loadById($cliente_productoDTO->getId_cliente(), $conexion);
    $servidorDTO->loadById($cliente_productoDTO->getId_servidor(), $conexion);
    $cuenta_cobro = $cliente_producto_cobroDAO->getAcountEnd();

    $numero_cuenta = $cuenta_cobro->numero_cuenta + 1;
    $nombre_cliente = $clienteDTO->getNombre();
    $cc_nit = $clienteDTO->getCcNit();
    $ip_servidor = $servidorDTO->getIp();
    $referencia = $cliente_productoDTO->getReferencia();
    $valor_pagar = $cliente_productoDTO->getSaldo();

    $nombre_cuenta = crearCuenta($fechas, $numero_cuenta, $nombre_cliente, $cc_nit, $ip_servidor, $referencia, $valor_pagar);
    
    if(file_exists("../public/pdf/$nombre_cuenta")){

       //inserta registro en la DB
       $cliente_producto_cobroDTO = new cliente_producto_cobroDTO(0, $cliente_productoDTO->getId_cliente_producto(), $nombre_cuenta, $numero_cuenta, 'generada', '', $valor_pagar);
       $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);
       $result = $cliente_producto_cobroDAO->insert($cliente_producto_cobroDTO);

       //envia el email
        //enviarEmail($cliente_productoDTO->getId_cliente(), $nombre_cuenta, $tipo_email_enviar, $ip_servidor, $conexion);
        //sleep(5);
    }else{
        throw new Exception("No existe pdf de Cuenta de cobro");
    } 

}

?>