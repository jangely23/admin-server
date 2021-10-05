<?php

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function crearCuenta($fechas, $numero_cuenta, $nombre_cliente, $cc_nit, $ip_servidor, $referencia, $valor_pagar){
?>

<!doctype html>
<html lang="es">
    <head>
        <style>
            @page {
                margin-top: 15px;
                margin-bottom: 15px;
                margin-left: 30px;
                margin-right: 30px;
                font-size: small;
            }

            header {
                position: static;
                height: auto;
                text-align: left;
                margin-left:35px;
            }

            main {
                position: relative;
                text-align: center;
                margin-left:40px;
            }

            .organizar{
                text-align: left;
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
            <img src="../public/images/logo.png" alt=""/>
            <br>
        </header>

        <footer>
            <p>Cra. 6 # 53-29 Oficina 804 Ed. Torreón Empresarial Santa Monica <br>Celular y WhatsApp (+57) 3009120695 <br>Ibagué - Tolima</p>
        </footer>

        <main> 
            <div>
                <p><?php echo $nombre_cliente."</br> NIT ".$cc_nit;?></p><br>
                <p>Debe a:</p><br><br>
                <p>FCOSYSTEMS </br>NIT: 93412119-4</p>
                <p>Por concepto: Alquiler Servidor<strong> <?php echo $ip_servidor;?> </strong> <br>del <?php echo $fechas[1]." al ".$fechas[2];?> </p><br><br>
                <p>Valor de $ <?php echo $valor_pagar;?> <br>Moneda corriente pesos colombianos<br><br>Fecha de corte facturación: <?php echo $fechas[0];?> <br>Fecha límite de pago: <?php echo $fechas[3];?> <br>Fecha de suspension: <?php echo $fechas[4];?></p><br><br><br>
                </div>
        
                <table>
                    <tr>
                        <td rowspan="4"><img src="../public/images/efectylogo.png" alt=""/></td>
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
                    <br><br><br>
                    <p><strong>DEPARTAMENTO CONTABLE.</strong><br>Tel: (+57)3009120695 <br>contabilidad@fcovoip.com</p>
                </div>
                
            </div>
        </main> 


    </body>
</html>

<?php
$html=ob_get_clean();
$options = new Options();
$options->set('defaultFont', ' Helvetica');
$options->setIsHtml5ParserEnabled(true);
$options->setIsRemoteEnabled(true);

$dompdf = new Dompdf($options);
$dompdf->setBasePath(dirname(__FILE__));

$dompdf->loadHtml($html);
$dompdf->setPaper('A4');
$dompdf->render();
$output = $dompdf->output();
file_put_contents("../public/pdf/".$nombre_cliente."_".$numero_cuenta.".pdf", $output);
//$dompdf->stream('report_'.date("dmYHis"));
return $nombre_cliente."_".$numero_cuenta.".pdf";
}
?>