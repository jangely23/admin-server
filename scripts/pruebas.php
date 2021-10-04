<?php 
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/servidor_detalleDAO.class.php';
require '../class/servidor_detalleDTO.class.php';

$id_servidor_detalle = filter_input(INPUT_POST,'id_servidor_detalle',FILTER_SANITIZE_NUMBER_INT)??0;

$servidor_detalleDTO = new servidor_detalleDTO();
$servidor_detalleDTO->loadById($id_servidor_detalle, $conexion);
?>


<form class="row g-3" method="POST" action="./process/cliente_producto_cobro.php" onsubmit="return enviarFormulario(this,'','');"> 
    <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
        <input type="hidden" class="form-control" id="id_servidor_detalle" name="id_servidor_detalle" value="<?php echo $servidor_detalleDTO->getId_servidor_detalle();?>">

        <input type="hidden" name="modo" id="modo" value="<?php echo $servidor_detalleDTO->getId_servidor_detalle()?"editar":"crear"; ?>">

        <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
    </div>
</form>

