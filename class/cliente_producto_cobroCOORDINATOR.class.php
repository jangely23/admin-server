<?php
require_once '../vendor/autoload.php';
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
        
        //Actualizar saldo en cliente producto con nota credito
        $cliente_productoDAO = new cliente_productoDAO($this->getConexion());
        $datos_producto = $cliente_productoDAO->getById($datos->id_cliente_producto);

        $descuento = ($datos_producto->precio_venta * $datos_producto->descuento)/100;
        $valor_venta = $datos_producto->precio_venta - $descuento;
        $nuevo_saldo = ($datos->valor - $valor_venta);

        $cliente_productoDTO =  new cliente_productoDTO($datos_producto->id_cliente_producto, $datos_producto->id_servidor, $datos_producto->id_cliente, $datos_producto->id_producto, $datos_producto->id_reseller, $datos_producto->ip_docker, $datos_producto->estado, $datos_producto->maxcall, $datos_producto->precio_venta, $datos_producto->referencia, $datos_producto->dominio, $nuevo_saldo , $datos_producto->descuento);
        
        $result_update = $cliente_productoDAO->update($cliente_productoDTO);
        

        if($result_update){

           // Generar nota credito
            $cliente_producto_pagoDAO = new cliente_producto_pagoDAO($this->getConexion());
            $cliente_producto_pagoDTO = new cliente_producto_pagoDTO(0, $datos->id_cliente_producto, date('Y-m-d h:i:s'), 'Nota credito', $datos_producto->precio_venta, 'cuenta numero: ' . $datos->numero_cuenta, 'Transaccion realizada por el sistema');  

            $result_pago = $cliente_producto_pagoDAO->insert($cliente_producto_pagoDTO);

            if($result_pago){

                //actualizar estado cuenta cobro
                $cliente_producto_cobroDTO = new cliente_producto_cobroDTO($datos->id_cliente_producto_cobro, $datos->id_cliente_producto, $datos->cuenta_cobro, $datos->numero_cuenta, $datos->fecha_corte, $datos->fecha_pago, $datos->fecha_suspension, 'cancelada', $datos->observacion, $datos->valor );
        
                $result = $cliente_producto_cobroDAO->update($cliente_producto_cobroDTO);
        
                if($result){
        
                    //Editar cuenta como cancelada
                    $pdf = new Fpdi();
                    $pdf->AddPage();
                    $pdf->setSourceFile(__DIR__ ."/../public/pdf/cuenta_cobro/$cuenta_cobro");
                    var_dump(__DIR__ );
                    var_dump(__FILE__ );
                    $template = $pdf->importPage(1);
                    $pdf->Image(__DIR__ ."/../public/images/cancelCuentaCobro.png", 0, 0, 210, 297,'png');
                    $pdf->useTemplate($template);
                    $pdf->Output(__DIR__ ."/../public/pdf/cuenta_cobro/$cuenta_cobro", "F");
        
                    //unlink("../public/pdf/$cuenta_cobro"); //Elimina el archivo                        
                    
                } 
            }
        }
  
        return $result;
    }
}

?>