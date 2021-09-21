<?php 
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/productoDAO.class.php';
require '../class/productoDTO.class.php';

$id_producto = filter_input(INPUT_POST,'id_producto',FILTER_SANITIZE_NUMBER_INT)??0;

$productoDTO = new productoDTO();
$productoDTO->loadById($id_producto, $conexion);

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Plataforma - producto
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/producto.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/producto.php','contenido','&id_producto=<?php echo $id_producto;?>')`)">

            <div class="col-md-3 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $productoDTO->getNombre();?>" placeholder="FCOVOIP">
            </div>

            <div class="col-md-6 mb-3">
                <label for="version" class="form-label">Version</label>
                <input type="text" class="form-control" id="version" name="version" placeholder="4.18.13" value="<?php echo $productoDTO->getVersion();?>" required="yes">
            </div> 

            <div class="col-md-3 mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" name="estado" id="id_txt_estado" required="yes">
                    <option value="disponible" <?php echo $productoDTO->getEstado()=="disponible"?"selected":"";?>>Disponible</option>
                    <option value="inutilizable" <?php echo $productoDTO->getEstado()=="inutilizable"?"selected":"";?>>Inutilizable</option>
                </select>
            </div>

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_producto" name="id_producto" value="<?php echo $id_producto; ?>">

                <input type="hidden" name="modo" id="modo" value="<?php echo $productoDTO->getId_producto()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>
        </form>
    </div>
</div>
