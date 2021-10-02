<?php
date_default_timezone_set('America/Bogota');
$fecha_actual = date('d-m-Y');

$inicio_corte = date("d-m-Y",strtotime($fecha_actual."+9 days"));
$fin_corte = date("d-m-Y",strtotime($fecha_corte_inicio_actual."+1 months, -1 days"));

if(date('d',strtotime($fecha_actual))==26){
    $fecha_pago = date("d-m-Y",strtotime($fecha_actual."+9 days"));
    $fecha_suspension = date("d-m-Y",strtotime($fecha_pago."+1 days"));

}else if(date('d',strtotime($fecha_actual))==02){        
    $fecha_pago = date("t-m-Y", strtotime($fecha_actual));
    $fecha_suspension = date("d-m-Y",strtotime($fecha_pago."+1 days")); 
}



echo "fecha pago actual: ".$fecha_pago . "</br>";
echo "fecha corte inicio actual: ".$inicio_corte."</br>";
echo "fecha corte final actual: ".$fin_corte."</br>";
echo "fecha suspension actual: ".$fecha_suspension."</br>";

?>
