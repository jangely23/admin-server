<?php
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/moduloDAO.class.php";
require "../class/moduloDTO.class.php";

$id_modulo = filter_input(INPUT_POST,'id_modulo',FILTER_SANITIZE_NUMBER_INT)??0;

$moduloDTO = new moduloDTO();
$moduloDTO->loadById($id_modulo,$conexion);

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Modulo
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/modulo.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/modulo.php','contenido','&id_modulo=<?php echo $id_modulo;?>')`)">

            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $moduloDTO->getNombre();?>" placeholder="Efecty">
            </div>

            <div class="col-md-6 mb-3">
                <label for="proveedor" class="form-label">Proveedor</label>
                <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="FCOMUNICACIONES S.A.S." value="<?php echo $moduloDTO->getProveedor();?>" required="yes">
            </div>
            
            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_modulo" name="id_modulo" value="<?php echo $id_modulo; ?>">

                <input type="hidden" name="modo" id="modo" value="<?php echo $moduloDTO->getId_modulo()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>
        </form>
    </div>
</div>

