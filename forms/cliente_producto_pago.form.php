<?php
require '../scripts/validarSession.php';
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/cliente_producto_pagoDAO.class.php';
require '../class/cliente_producto_pagoDTO.class.php';

$id_cliente_producto = filter_input(INPUT_POST, 'id_cliente_producto', FILTER_SANITIZE_NUMBER_INT)??0;
$id_cliente_producto_pago = filter_input(INPUT_POST, 'id_cliente_producto_pago', FILTER_SANITIZE_NUMBER_INT)??0;

$cliente_producto_pagoDTO = new cliente_producto_pagoDTO();
$cliente_producto_pagoDTO->loadById($id_cliente_producto_pago, $conexion);

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Realizar pago
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/cliente_producto_pago.process.php"  enctype="multipart/form-data" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/cliente_producto.php','contenido','')`)">

            <div class="col-md-6 mb-3">
                <label for="medio_pago" class="form-label">Medio de pago</label>
                <select class="form-select" aria-label="Default select example" name="medio_pago" id="medio_pago" required="yes" >
                    <option value="Efecty" <?php echo $cliente_producto_pagoDTO->getMedio_pago()=="Efecty"?"selected":"";?> >Efecty</option>
                    <option value="Bancolombia_Francisco" <?php echo $cliente_producto_pagoDTO->getMedio_pago()=="Bancolombia_Francisco"?"selected":"";?> >Bancolombia_Francisco</option>
                    <option value="Cruce_cuentas_interno" <?php echo $cliente_producto_pagoDTO->getMedio_pago()=="Cruce_cuentas_interno"?"selected":"";?> >Cruce_cuentas_interno</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input autocomplete="off" type="text" class="form-control" id="valor" name="valor" placeholder="50000" value="<?php echo $cliente_producto_pagoDTO->getValor();?>" required="yes">
            </div> 

            <div class="col-md-6 mb-3">
                <label for="validacion" class="form-label">Validacion de pago</label>
                <input autocomplete="off" type="text" class="form-control" id="validacion" name="validacion" value="<?php echo $cliente_producto_pagoDTO->getValidacion();?>" required="yes">
            </div>

            <div class="col-md-6 mb-3" id="id_soporte_pago">
                <label for="soporte" class="form-label">Comprobante de pago</label>
                <input type="file" class="form-control" id="soporte" name="soporte" placeholder="soporte" value="<?php echo $cliente_producto_pagoDTO->getSoporte();?>">
            </div> 

 

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $id_cliente_producto; ?>">

                <input type="hidden" name="modo" id="modo" value="<?php echo $cliente_producto_pagoDTO->getId_cliente_producto()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info ">Guardar</button>
            </div>
        </form>
    </div>

</div>