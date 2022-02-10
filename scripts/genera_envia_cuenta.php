<?php
header('Content-type: image/jpeg'); 
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
include "./crear_cuenta.php";
include "./enviar_email.php";

$cliente_productoDTO = new cliente_productoDTO();
$cliente_productoDAO = new cliente_productoDAO($conexion);

$clienteDTO = new clienteDTO();
$servidorDTO = new servidorDTO();
$cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);

$tipo_email_enviar = "cuenta_cobro";  //permitira a futuro validar si el mail a enviar es de cobro, suspension o cancelacion.

$x_minuto = 0; //0 no es server x minuto, 1 si es server por minuto

//Establece fechas de facturacion para cuenta de cobro y obtiene los cliente_producto a cobrar
date_default_timezone_set('America/Bogota');

$fecha_actual = date('Y-m-d');

$inicio_corte = date("Y-m-d",strtotime($fecha_actual."+9 days"));
$fin_corte = date("Y-m-d",strtotime($inicio_corte."+1 months, -1 days"));
$prueba=date('d',strtotime($fecha_actual));

if(date('d',strtotime($fecha_actual))==16){  //validacion fechas de fcovoip y simple
    $fecha_pago = date("Y-m-d",strtotime($fecha_actual."+9 days"));
    $fecha_suspension = date("Y-m-d",strtotime($fecha_pago."+1 days"));

    $cliente_productos = $cliente_productoDAO->getAllByCheck($x_minuto);
    
}else if(date('d',strtotime($fecha_actual))==26){ 
    $inicio_corte = date("Y-m-d",strtotime($fecha_actual."-1 days")); 
    $fecha_pago = date("Y-m-t", strtotime($fecha_actual));
    $fecha_suspension = date("Y-m-d",strtotime($fecha_pago."+1 days")); 
    
    $x_minuto = 1;
    $cliente_productos = $cliente_productoDAO->getAllByCheck($x_minuto); //consulta los sever-cliente a cobrar que estan activos y son x min
}

$fechas = array($fecha_actual, $inicio_corte, $fin_corte, $fecha_pago, $fecha_suspension); // array a enviar para generar cuenta de cobro

while($obj = $cliente_productos->fetch_object()){
    $cliente_productoDTO->map($obj);
    $clienteDTO->loadById($cliente_productoDTO->getId_cliente(), $conexion);
    $servidorDTO->loadById($cliente_productoDTO->getId_servidor(), $conexion);
    $cuenta_cobro = $cliente_producto_cobroDAO->getAcountEnd();

    //datos basicos para generar cuenta de cobro 
    $numero_cuenta = $cuenta_cobro->numero_cuenta + 1;
    $nombre_cliente = $clienteDTO->getNombre();
    $cc_nit = $clienteDTO->getCcNit();
    $ip_servidor = $servidorDTO->getIp();
    $referencia = $cliente_productoDTO->getReferencia();

    //valida el valor a pagar a anexar en la cuenta de cobro
    $descuento = ($cliente_productoDTO->getPrecio_venta() * $cliente_productoDTO->getDescuento())/100;
    $valor_total = $cliente_productoDTO->getPrecio_venta() - $descuento;
    $valor_pagar = $valor_total + $cliente_productoDTO->getSaldo();

    $nombre_cuenta = crearCuenta($fechas, $numero_cuenta, $nombre_cliente, $cc_nit, $ip_servidor, $referencia, $valor_pagar);
    
    if(file_exists("../public/pdf/cuenta_cobro/$nombre_cuenta")){

        //inserta registro del cobro en la DB
        $cliente_producto_cobroDTO = new cliente_producto_cobroDTO(0, $cliente_productoDTO->getId_cliente_producto(), $nombre_cuenta, $numero_cuenta, $inicio_corte ." 00:00:00", $fecha_pago ." 00:00:00" , $fecha_suspension . " 00:00:00", 'generada', "valor server ".$cliente_productoDTO->getPrecio_venta()." con descuento de ".$cliente_productoDTO->getDescuento()."%" . ", saldo pendiente de pago mes anterior ".$cliente_productoDTO->getSaldo(), $valor_pagar);
        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);
        $result = $cliente_producto_cobroDAO->insert($cliente_producto_cobroDTO);

        //actualiza info saldo cliente producto
        $cliente_productoDTO_nuevo = new cliente_productoDTO($cliente_productoDTO->getId_cliente_producto(), $cliente_productoDTO->getId_servidor(), $cliente_productoDTO->getId_cliente(), $cliente_productoDTO->getId_producto(), $cliente_productoDTO->getId_reseller(), $cliente_productoDTO->getIp_docker(), $cliente_productoDTO->getEstado(), $cliente_productoDTO->getMaxcall(), $cliente_productoDTO->getPrecio_venta(), $cliente_productoDTO->getReferencia(), $cliente_productoDTO->getDominio(), $valor_pagar, $cliente_productoDTO->getDescuento());
        $result = $cliente_productoDAO->update($cliente_productoDTO_nuevo);
       
        //envia el email
        //enviarEmail($cliente_productoDTO->getId_cliente(), $nombre_cuenta, $tipo_email_enviar, $ip_servidor, $conexion);
        sleep(3);
        
    }else{
        throw new Exception("No existe pdf de Cuenta de cobro");
    } 

}
