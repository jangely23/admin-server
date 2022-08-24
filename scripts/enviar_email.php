<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

//crear el objeto $mail de PHPmailer
$mail = new PHPMailer(true);

$contacto_clienteDTO = new contacto_clienteDTO();

function enviarEmail(int $id_cliente, string $adjunto ='',$ip_servidor, $conexion){
    $clienteDTO = new clienteDTO();
    $clienteDTO->loadById($id_cliente, $conexion);

    $contacto_clienteDAO = new contacto_clienteDAO($conexion);
    $datos_contacto = $contacto_clienteDAO->getAllEmail($id_cliente); 
    
    global $mail; //llama la instancia realizada antes de la funcion

    try{
    
    $mail->isSMTP();//protocolo a usar
    $mail->SMTPAuth = true;//configuracion de autenticacion
    $mail->SMTPSecure ='ssl';//tipo de seguridad a usar tls o ssl
    $mail->Host ='smtp.gmail.com';//host de gmail o servidor de correos
    $mail->Port ='465'; //puerto a usar 465 o 587
    $mail->Username = 'contabilidad@fcovoip.com'; //correo desde el cual se van a enviar los mail
    $mail->Password = 'CalidadYEfectividad2022';//contraseña del correo
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // puede ser PHPMailer::ENCRYPTION_SMTPS;

    //parametros de envio
    $mail->setFrom('contabilidad@fcovoip.com','Contabilidad FCOVOIP');//correo de quien envia
    
    $count = 0;
    $datos=$datos_contacto->fetch_all();
    foreach($datos as $row){
        foreach($row as $valor){
            $count = $count + 1;
            $mail->addAddress($valor);
        }    
    }

   
    $mail->addAttachment('../public/pdf/cuenta_cobro'.$adjunto, $clienteDTO->getNombre().'.pdf');
    $mail->CharSet = 'UTF-8';
    $mail->Subject = "Cuenta cobro servidor IP  $ip_servidor";//asunto del correo
    $mail->Body = '<p>Muy buen dia</p><p>Sr(a) '.$clienteDTO->getNombre().'</p><p>Mediante el presente correo se anexa la cuenta cobro del  servicio que usted adquirio con nuestra empresa, el no pago genera el riesgo de suspensión del servicio.</p><p>
    Cualquier inquietud por favor comunicarse a este numero telefonico +57 3009120695.</p>'; //contenido del mensaje
    $mail->IsHTML(true); // permite el uso de HTML
    $mail->send();
        
    $mail->clearAddresses();
    $mail->clearAttachments();
      
    }catch (Exception $e) {
        echo "Email no pudo ser enviado. Error: {$mail->ErrorInfo}";
    }

}

?>