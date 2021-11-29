<?php
require '../scripts/validarSession.php';
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/usuarioDAO.class.php';
require '../class/usuarioDTO.class.php';

$usuarioDTO = new usuarioDTO();

$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT)??0;

$usuarioDTO->loadById($id_usuario, $conexion);

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Usuarios
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/usuario.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/usuario.php','contenido','&id_usuario=<?php echo $id_usuario;?>')`)">

            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $usuarioDTO->getNombre();?>" placeholder="Jessica Leonel">
            </div>

            <div class="col-md-3 mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input autocomplete="off" type="text" class="form-control" id="usuario" name="usuario" placeholder="JessicaL" value="<?php echo $usuarioDTO->getUsuario();?>" required="yes">
            </div> 

            <div class="col-md-3 mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" name="estado" id="id_txt_estado" required="yes">
                    <option value="activo" <?php echo $usuarioDTO->getEstado()=="activo"?"selected":"";?>>Activo</option>
                    <option value="inactivo" <?php echo $usuarioDTO->getEstado()=="inactivo"?"selected":"";?>>Inactivo</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label for="clave" class="form-label">Clave</label>
                <input type="password" class="form-control" id="clave" name="clave" placeholder="clave" value="<?php echo $usuarioDTO->getClave();?>" onfocus="confirmarClave();" required="yes">
            </div> 

            <div class="col-md-3 mb-3">
                <label for="claveConfirmacion" class="form-label">Confirmacion Clave<small class="ms-3 s" id="alerta"> <i class="fas fa-check-circle"></i></small></label>
                <input autocomplete="off" type="password" class="form-control" id="claveConfirmacion" name="claveConfirmacion" placeholder="confirmar clave" value="<?php echo $usuarioDTO->getClave();?>" onkeyup="confirmarClave();"  required="yes">
            </div> 

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input autocomplete="off" type="text" class="form-control" id="email" name="email" placeholder="JessicaL" value="<?php echo $usuarioDTO->getEmail();?>" required="yes">
            </div> 

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" value="<?php echo $id_usuario; ?>">

                <input type="hidden" name="modo" id="modo" value="<?php echo $usuarioDTO->getId_usuario()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info disabled">Guardar</button>
            </div>
        </form>
    </div>

</div>