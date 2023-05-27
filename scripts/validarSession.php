<?php  
session_name("admin");
session_start();

$en_session = isset($_SESSION['en_session'])?$_SESSION['en_session']:false;

if(!$en_session){
    $respuesta=array("en_session"=>"false","error"=>"Session No Valida");
    $json= json_encode($respuesta);
    die($json);
    header("Location: ../login.php");
}

?>