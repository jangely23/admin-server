<?php 
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/resellerDAO.class.php';
require '../class/resellerDTO.class.php';

$id_reseller = filter_input(INPUT_POST,'id_reseller',FILTER_SANITIZE_NUMBER_INT)??0;

$resellerDTO = new resellerDTO();
$resellerDTO->loadById($id_reseller, $conexion);

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Reseller
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/reseller.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/reseller.php','contenido','&id_reseller=<?php echo $id_reseller;?>')`)">

            <div class="col-md-3 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $resellerDTO->getNombre();?>" placeholder="Fcomuniacionoes S.A.S">
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="corre@correo.com" value="<?php echo $resellerDTO->getEmail();?>" required="yes">
            </div> 

            <div class="col-md-3 mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="number" class="form-control" id="celular" name="celular" value="<?php echo $resellerDTO->getCelular();?>" required="yes" placeholder="573009120695">
            </div>

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_reseller" name="id_reseller" value="<?php echo $id_reseller; ?>">

                <input type="hidden" name="modo" id="modo" value="<?php echo $resellerDTO->getId_reseller()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>
        </form>
    </div>
</div>

