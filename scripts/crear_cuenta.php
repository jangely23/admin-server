<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
//use Dompdf\Image\Cache;
//use Dompdf\Helpers;
//use Dompdf\Canvas;

function crearCuenta($fechas, $numero_cuenta, $nombre_cliente, $cc_nit, $ip_servidor, $referencia, $valor_pagar){
ob_start();

$logo= '../public/images/logo.jpg';
$logoBase64 = "data:image/jpeg;base64,". base64_encode(file_get_contents($logo));

$logoefecty= '../public/images/efectylogo.jpg';
$logoefectyBase64 = "data:image/jpeg;base64,". base64_encode(file_get_contents($logoefecty));

?>

<!doctype html>
<html lang="es">
    <head>
        <style>
            @page {
                margin-top: 15px;
                margin-bottom: 15px;
                margin-left: 50px;
                margin-right: 50px;
                font-size: small;
            }

            header {
                bottom: 5px;
                position: static;
                height: auto;
                margin-left:30px;
                text-align: justify;
            }

            main {
                position: relative;
                text-align: center;
                margin-left:30px;
            }

            .organizar{
                text-align: left;
                margin-left:30px;
            }

            footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                text-align: center;
                color:dimgrey;
            }


        </style>
    </head>

    <body>
        <header>
            <img src="<?php echo $logoBase64;?>" alt=""/>
            <p> Cuenta Nº <?php echo $numero_cuenta;?> - Ibagué, <?php echo $fechas[0];?>  </p>
            <br>
        </header>

        <footer>
            <p>Cra. 6 # 53-29 Oficina 804 Ed. Torreón Empresarial Santa Monica <br>Celular y WhatsApp (+57) 3009120695 <br>Ibagué - Tolima</p>
        </footer>

        <main> 
            <div>
                <h3><?php echo $nombre_cliente;?></h3>

                <?php if($cc_nit != "") {?>
                    <?php echo "<p> NIT &nbsp; ".$cc_nit."</p>";?><br>
                <?php } ?>
                <p>Debe a:<br> FCOSYSTEMS </br>NIT: 93412119-4</p>
                <p>Por concepto: Alquiler Servidor Cloud IP <?php echo $ip_servidor;?> <br>del <?php echo $fechas[1]." al ".$fechas[2];?> </p><br><br>
                <p>Valor de USD <?php echo $valor_pagar;?> <br>Moneda dolar estadounidense<br><b>Pago en pesos al cambio de la TRM del día del pago</b><br><br>Fecha de corte facturación: <?php echo $fechas[1];?> <br>Fecha límite de pago: <?php echo $fechas[3];?> <br>Fecha de suspension: <?php echo $fechas[4];?></p><br><br><br>
                </div>
        
                <table>
                    <tr>
                        <td rowspan="4"><img src="<?php echo $logoefectyBase64;?>" alt=""/></td>
                    </tr>
                    <tr> 
                        <td>NOMBRE DEL CONVENIO:</td>
                        <td><strong> RECARGAS VOIP </strong></td>
                    </tr>
                    <tr> 
                        <td>CODIGO DEL PROYECTO:</td>
                        <td><strong> 110365 </strong></td>
                    </tr>
                    <tr> 
                        <td>REFERENCIA DEL PAGO:</td>
                        <td><strong><?php echo $referencia;?></strong></td>
                    </tr>
                </table><br><br>
                <div class="organizar">
                    <p>Una vez realizado el pago enviar el comprobante al correo electrónico contabilidad@fcovoip.com<br><br><br></p>
                    <br><br>
                    <p><strong>DEPARTAMENTO CONTABLE.</strong><br>Tel: (+57)3009120695 <br>contabilidad@fcovoip.com</p>
                </div>
                
            </div>
        </main> 


    </body>
</html>

<?php
$html=ob_get_clean();
$options = new Options();
$options->set('defaultFont', 'Helvetica');
$options->setIsHtml5ParserEnabled(true);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);
$dompdf->setBasePath(dirname(__FILE__));

$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$output = $dompdf->output();
file_put_contents("../public/pdf/cuenta_cobro/".$nombre_cliente."_".$numero_cuenta.".pdf", $output);
//$dompdf->stream('report_'.date("dmYHis"));

return $nombre_cliente."_".$numero_cuenta.".pdf";
}

?>