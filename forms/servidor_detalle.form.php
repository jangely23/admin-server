<?php 
require '../scripts/validarSession.php';
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/servidor_detalleDAO.class.php';
require '../class/servidor_detalleDTO.class.php';

$id_servidor_detalle = filter_input(INPUT_POST,'id_servidor_detalle',FILTER_SANITIZE_NUMBER_INT)??0;

$servidor_detalleDTO = new servidor_detalleDTO();
$servidor_detalleDTO->loadById($id_servidor_detalle, $conexion);
?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Detalle plan servidor
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/servidor_detalle.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/servidor_detalle.php', 'contenido', '&txt_busqueda='+$('#id_txt_plan').val());`);"> 

            <div class="col-md-3 mb-3">
                <label for="id_txt_plan" class="form-label">Plan</label>
                <input type="text" class="form-control" id="id_txt_plan" name="plan" placeholder="VPS1/dedicado" value="<?php echo $servidor_detalleDTO->getPlan_servidor(); ?>" required="yes">
            </div>

            <div class="col-md-2 mb-3">
                <label for="id_txt_ram" class="form-label">Ram</label>
                <input type="text" class="form-control" id="id_txt_ram" name="ram" placeholder="2GB" value="<?php echo $servidor_detalleDTO->getRam(); ?>" required="yes">
            </div>

            <div class="col-md-2 mb-3">
                <label for="id_txt_disco" class="form-label">Disco</label>
                <input type="text" class="form-control" id="id_txt_disco" name="disco" placeholder="SSD 500GB" value="<?php echo $servidor_detalleDTO->getDisco(); ?>" required="yes">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_procesador" class="form-label">Procesador</label>
                <input type="text" class="form-control" id="id_txt_procesador" name="procesador" placeholder="2 core" value="<?php echo $servidor_detalleDTO->getProcesador(); ?>" required="yes">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_datacenter" class="form-label">Datacenter</label>
                <input type="text" class="form-control" id="id_txt_datacenter" name="datacenter" placeholder="OVH" value="<?php echo $servidor_detalleDTO->getDatacenter(); ?>" required="yes">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_raid" class="form-label">Raid</label>
                <input type="text" class="form-control" id="id_txt_raid" name="raid" placeholder="10" value="<?php echo $servidor_detalleDTO->getRaid(); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_costo" class="form-label">Costo</label>
                <input type="number" step="any" min=0 class="form-control" id="id_txt_costo" name="costo" placeholder="3.5" value="<?php echo $servidor_detalleDTO->getCosto(); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_moneda" class="form-label">Moneda</label>
                <select class="form-select" aria-label="Default select example" name="moneda" id="moneda" required="yes">
                    <option value="USD" <?php echo $servidor_detalleDTO->getMoneda()=="USD"?"selected":"";?>>USD</option>
                    <option value="COP" <?php echo $servidor_detalleDTO->getMoneda()=="COP"?"selected":"";?>>COP</option>
                    <option value="EUR" <?php echo $servidor_detalleDTO->getMoneda()=="EUR"?"selected":"";?>>EUR</option>
                </select>
            </div>

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_servidor_detalle" name="id_servidor_detalle" value="<?php echo $servidor_detalleDTO->getId_servidor_detalle();?>">

                <input type="hidden" name="modo" id="modo" value="<?php echo $servidor_detalleDTO->getId_servidor_detalle()?"editar":"crear"; ?>">

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>

            </div>

        </form>
    </div>
</div>