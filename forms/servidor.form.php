<?php
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/servidorDTO.class.php";
require "../class/servidorDAO.class.php";
require "../class/servidor_detalleDTO.class.php";
require "../class/servidor_detalleDAO.class.php";

$id_servidor = filter_input(INPUT_POST,'id_servidor',FILTER_SANITIZE_NUMBER_INT)??0;

$servidorDTO = new servidorDTO();
$servidorDTO->loadById($id_servidor, $conexion);

$servidor_detalleDTO = new servidor_detalleDTO();
$servidor_detalleDAO = new servidor_detalleDAO($conexion);
$plan = $servidor_detalleDAO->getAllPage();
?>
<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3">
            Servidores
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/servidor.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/servidor.php','contenido','&txt_busqueda='+$('#id_txt_ip').val());`);">
            
            <div class="col-md-3 mb-3">
                <label for="id_txt_ip" class="form-label">IP</label>
                <input type="text" class="form-control" id="id_txt_ip" name="ip" placeholder="ip" value="<?php echo $servidorDTO->getIp(); ?>" required="yes">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_estado" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" name="estado" id="id_txt_estado" required="yes">
                    <option value="libre" <?php echo $servidorDTO->getEstado()=="libre"?"selected":"";?>>Libre</option>
                    <option value="uso" <?php echo $servidorDTO->getEstado()=="uso"?"selected":"";?>>Uso</option>
                    <option value="entregado" <?php echo $servidorDTO->getEstado()=="entregado"?"selected":"";?>>Entregado</option>
                </select>
            </div>
            
            <div class="col-md-2 mb-3">
                <label for="id_txt_tipo" class="form-label">Tipo</label>
                <select class="form-select" aria-label="Default select example" name="tipo" id="id_txt_tipo" required="yes">
                    <option value="vz" <?php echo $servidorDTO->getTipo()=="vz"?"selected":"";?>>VZ</option>
                    <option value="vps" <?php echo $servidorDTO->getTipo()=="vps"?"selected":"";?>>VPS</option>
                    <option value="dedidado" <?php echo $servidorDTO->getTipo()=="dedicado"?"selected":"";?>>Dedidado</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="id_txt_servidor_detalle">Plan server</label>
                <select class="form-select mt-2" aria-label="Default select example" name="id_servidor_detalle" id="id_txt_servidor_detalle" required="yes">
                    <?php 
                    while ($obj = $plan->fetch_object()){
                        $servidor_detalleDTO->map($obj);
                    ?>
                        <option value="<?php echo $servidor_detalleDTO->getId_servidor_detalle();  ?>" <?php echo $servidorDTO->getId_servidor_detalle()==$servidor_detalleDTO->getId_servidor_detalle()?"selected":"";?>><?php echo $servidor_detalleDTO->getPlan_servidor(). $servidor_detalleDTO->getDatacenter()?></option>

                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_nombre ">Nombre</label>
                <input type="text" class="form-control mt-2" id="id_txt_nombre" name='nombre' placeholder="vps-starting-1234.ovh" value="<?php echo $servidorDTO->getNombre(); ?>">
            </div> 

            <div class="col-md-3 mb-3">
                <label for="id_txt_periodicidad_pago" class="form-label">Forma de pago</label>
                <select class="form-select" aria-label="Default select example" name="periodicidad_pago" id="id_txt_periodicidad_pago" required="yes">
                    <option value="mensual" <?php echo $servidorDTO->getPeriodicidad_pago()=="mesual"?"selected":"";?>>Mensual</option>
                    <option value="anual" <?php echo $servidorDTO->getPeriodicidad_pago()=="anual"?"selected":"";?>>Anual</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="id_txt_observacion">Observaciones</label>
                <textarea class="form-control mt-2" id="id_txt_observacion" name='observacion' rows="1"><?php echo $servidorDTO->getObservacion(); ?></textarea>
            </div> 

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_servidor" name="id_servidor" value="<?php echo $servidorDTO->getId_servidor(); ?>">
                
                <input type="hidden" name="modo" id="modo" value="<?php echo $servidorDTO->getId_servidor()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>

            
        </form>
    </div>
</div>