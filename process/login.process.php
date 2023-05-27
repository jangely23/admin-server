<?php

require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/usuarioDAO.class.php';
require '../class/usuarioDTO.class.php';
require '../class/usuarioCOORDINATOR.class.php';

$usuarioCOORDINATOR=new usuarioCOORDINATOR($conexion);

if($usuarioCOORDINATOR->login()){
    header("Location: ../index.php");
}else{
    header("Location: ../login.php?error=error");
}

?>