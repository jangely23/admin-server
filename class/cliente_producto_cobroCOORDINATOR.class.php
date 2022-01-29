<?php
require_once 'vendor/autoload.php';
use Fpdf\Fpdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

class cliente_producto_cobroCOORDINATOR extends conexion{
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    function deleteByPost(){
        $id_cliente_producto_cobro = filter_input(INPUT_POST,'id_cliente_producto_cobro',FILTER_SANITIZE_NUMBER_INT);
        $cuenta_cobro = filter_input(INPUT_POST,'cuenta_cobro',FILTER_SANITIZE_STRING);

        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($this->getConexion());
        $datos = $cliente_producto_cobroDAO->getById($id_cliente_producto_cobro);
        
        $cliente_producto_cobroDTO = new cliente_producto_cobroDTO($datos->id_cliente_producto_cobro, $datos->id_cliente_producto, $datos->cuenta_cobro, $datos->numero_cuenta, $datos->fecha_corte, $datos->fecha_pago, $datos->fecha_suspension, 'cancelada', $datos->observacion, $datos->valor );
        
        $result = $cliente_producto_cobroDAO->update($cliente_producto_cobroDTO);

        if($result){
            $pdf = new Fpdi();
            $pdf->AddPage('P', 'Letter');
		    $pdf->setSourceFile(__DIR__ . "/../public/pdf/template/template_cancel.pdf");
		    $template = $pdf->importPage(1);
            $pdf->useTemplate($template);
            $pdf->setSourceFile(__DIR__ . "/../public/pdf/cuentas_cobro/".$cuenta_cobro);
            $template = $pdf->importPage(1);
            $pdf->useTemplate($template);
            $pdf->Output(__DIR__ . "/../public/pdf/cuentas_cobro/".$cuenta_cobro); 

            //unlink("../public/pdf/$cuenta_cobro"); //Elimina el archivo
        }

        return $result;
    }
}

?>