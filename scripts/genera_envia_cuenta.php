<?php
header('Content-type: image/jpeg'); 
include "../config/conexion.php";
include "../class/conexion.class.php";
include "../class/cliente_producto_cobroDAO.class.php";
include "../class/cliente_producto_cobroDTO.class.php";
include "../class/cliente_productoDAO.class.php";
include "../class/cliente_productoDTO.class.php";
include "../class/contacto_clienteDAO.class.php";
include "../class/contacto_clienteDTO.class.php";
include "../class/clienteDAO.class.php";
include "../class/clienteDTO.class.php";
include "../class/servidorDAO.class.php";
include "../class/servidorDTO.class.php";
include "./crear_cuenta.php";
include "./enviar_email.php";
include "/usr/local/sbin/consumo_server_x_minuto.php"; 


$cliente_productoDTO = new cliente_productoDTO();
$cliente_productoDAO = new cliente_productoDAO($conexion);

$clienteDTO = new clienteDTO();
$servidorDTO = new servidorDTO();
$cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);

//Establece fechas de facturacion para cuenta de cobro y obtiene los cliente_producto a cobrar
date_default_timezone_set('America/Bogota');

$tipo_email_enviar = "cuenta_cobro";  //permitira a futuro validar si el mail a enviar es de cobro, suspension o cancelacion.

$x_minuto = $_POST['x_minuto']==true?1:0; //0 no es server x minuto, 1 si es server por minuto
$moneda_usd = $_POST['moneda_usd']; //true es pesos, false es dolares

$valor_dolar_cambio = 3600;
$fecha_actual = date('Y-m-d');

$inicio_corte = filter_input(INPUT_POST,'inicio_corte',FILTER_SANITIZE_STRING);
$fin_corte = date("Y-m-d",strtotime($inicio_corte."+1 months, -1 days"));

$fecha_pago = filter_input(INPUT_POST,'fecha_pago',FILTER_SANITIZE_STRING);
$fecha_suspension = filter_input(INPUT_POST,'fecha_suspension',FILTER_SANITIZE_STRING);

$cliente_productos = $cliente_productoDAO->getAllByCheck($x_minuto); //consulta los sever-cliente a cobrar que estan activos y son x min

$fechas = array($fecha_actual, $inicio_corte, $fin_corte, $fecha_pago, $fecha_suspension); // array a enviar para generar cuenta de cobro

while($obj = $cliente_productos->fetch_object()){
    $cliente_productoDTO->map($obj);
    $clienteDTO->loadById($cliente_productoDTO->getId_cliente(), $conexion);
    $servidorDTO->loadById($cliente_productoDTO->getId_servidor(), $conexion);
    $cuenta_cobro = $cliente_producto_cobroDAO->getAcountEnd();

    //datos basicos para generar cuenta de cobro 
    if ($cuenta_cobro==0){
        $numero_cuenta=8978;
    }else{
        $numero_cuenta = $cuenta_cobro + 1;
    }
    
    $nombre_cliente = $clienteDTO->getNombre();
    $cc_nit = $clienteDTO->getCcNit();
    $ip_servidor = $servidorDTO->getIp();
    $referencia = $cliente_productoDTO->getReferencia();

    if($x_minuto==1){

	$valor_consumido_x_minuto=consumoServer($cliente_productoDTO->getDominio());
	    
	if(intval($valor_consumido_x_minuto)){
		$cliente_productoDTO->setPrecio_venta($valor_consumido_x_minuto);
	}
    }
    

    //valida el valor a pagar a anexar en la cuenta de cobro
    $descuento = ($cliente_productoDTO->getPrecio_venta() * $cliente_productoDTO->getDescuento())/100;
    $valor_total = $cliente_productoDTO->getPrecio_venta() - $descuento;
    $valor_pagar_cliente = $valor_total + $cliente_productoDTO->getSaldo();

    if($moneda_usd){
        $conversion = ($valor_total / $valor_dolar_cambio);
        $valor_pagar = number_format($conversion, 2, ".", "");;
    }else{
        $valor_pagar = $valor_total;
    }
    

    $nombre_cuenta = crearCuenta($fechas, $numero_cuenta, $nombre_cliente, $cc_nit, $ip_servidor, $referencia, $valor_pagar);   
    
    if(file_exists("./../public/pdf/cuenta_cobro/$nombre_cuenta")){
        
        //inserta registro del cobro en la DB
        $cliente_producto_cobroDTO = new cliente_producto_cobroDTO(0, $cliente_productoDTO->getId_cliente_producto(), $nombre_cuenta, $numero_cuenta, $inicio_corte ." 00:00:00", $fecha_pago ." 00:00:00" , $fecha_suspension . " 00:00:00", 'generada', "valor server ".$cliente_productoDTO->getPrecio_venta()." con descuento de ".$cliente_productoDTO->getDescuento()."%" . ", saldo pendiente de pago mes anterior ".$cliente_productoDTO->getSaldo(), $valor_pagar);
        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);
        $result = $cliente_producto_cobroDAO->insert($cliente_producto_cobroDTO);

        //actualiza info saldo cliente producto
        $cliente_productoDTO_nuevo = new cliente_productoDTO($cliente_productoDTO->getId_cliente_producto(), $cliente_productoDTO->getId_servidor(), $cliente_productoDTO->getId_cliente(), $cliente_productoDTO->getId_producto(), $cliente_productoDTO->getId_reseller(), $cliente_productoDTO->getIp_docker(), $cliente_productoDTO->getEstado(), $cliente_productoDTO->getMaxcall(), $cliente_productoDTO->getPrecio_venta(), $cliente_productoDTO->getReferencia(), $cliente_productoDTO->getDominio(), $valor_pagar_cliente, $cliente_productoDTO->getDescuento());
        $result = $cliente_productoDAO->update($cliente_productoDTO_nuevo);
        
        //envia el email
        enviarEmail($cliente_productoDTO->getId_cliente(), $nombre_cuenta, $ip_servidor, $conexion);
        sleep(3);
        
    }else{
        throw new Exception("No existe pdf de Cuenta de cobro");
    } 

}

?>
