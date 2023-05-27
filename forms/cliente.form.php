<?php
require '../scripts/validarSession.php';
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/clienteDTO.class.php";
require "../class/clienteDAO.class.php";
require "../class/contacto_clienteDTO.class.php";
require "../class/contacto_clienteDAO.class.php";

$id_cliente = filter_input(INPUT_POST, 'id_cliente',FILTER_SANITIZE_NUMBER_INT)??0;

$clienteDTO = new clienteDTO();
$clienteDTO->loadById($id_cliente, $conexion);

$contacto_clienteDTO = new contacto_clienteDTO();
$contacto_clienteDAO = new contacto_clienteDAO($conexion);
$contactos_cliente = $contacto_clienteDAO->getAllPage($clienteDTO->getIdCliente());

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3">  
            Clientes
        </legend>
    </fieldset>
    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/cliente.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/cliente.php', 'contenido', '&txt_busqueda='+$('#id_txt_nombre').val());`);">
            <div class="col-md-6 mb-3">
                <label for="id_txt_nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="id_txt_nombre" name="nombre" placeholder="nombre" value="<?php echo $clienteDTO->getNombre(); ?>" required="yes">
            </div>
            
            <div class="col-md-3 mb-3">
                <label for="id_txt_cc_nit" class="form-label">CC-NIT</label>
                <input type="text" class="form-control" id="id_txt_cc_nit" name="cc_nit" placeholder="cedula o nit" value="<?php echo $clienteDTO->getCcNit(); ?>">
            </div>
                    
            <div class="col-md-3 mb-3">
                <label for="id_txt_estado" class="form-label">Estado</label>
                <select class="form-select" aria-label="Default select example" name="estado" id="estado" required="yes">
                    <option value="activo" <?php echo $clienteDTO->getEstado()=="activo"?"selected":"";?>>Activo</option>
                    <option value="inactivo" <?php echo $clienteDTO->getEstado()=="inactivo"?"selected":"";?>>Inactivo</option>
                </select>
            </div>
            
            <div class="col-md-6 mb-3">
                <label for="id_txt_administrador" class="form-label">Administrador</label>
                <input type="text" class="form-control" id="id_txt_cc_administrador" name="administrador" placeholder="administrador" value="<?php echo $clienteDTO->getAdministrador(); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control" id="id_txt_ciudad" name="ciudad" placeholder="ciudad" value="<?php echo $clienteDTO->getCiudad(); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="id_txt_pais" class="form-label">Pais</label>
                <input type="text" class="form-control" id="id_txt_pais" name="pais" placeholder="pais" value="<?php echo $clienteDTO->getPais(); ?>">
            </div>
                        
            <div class="col-md-6 mb-3">
                <label for="id_txt_direccion" class="form-label">Direccion</label>
                <input type="text" class="form-control" id="id_txt_direccion" name="direccion" placeholder="direccion" value="<?php echo $clienteDTO->getDireccion(); ?>">
            </div>
            
            <?php  if($contactos_cliente ->num_rows == 0){ ?>

            <div class="col-md-3 mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" value="" placeholder="5782771207">
            </div>

            <div class="col-md-3 mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="number" class="form-control" id="celular" name="celular" value="" required="yes" placeholder="573009120695">
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="corre@correo.com" value="" required="yes">
            </div>

            <div class="col-md-6 mb-3">
                <label for="otro" class="form-label">Otra informacion</label>
                <input type="text" class="form-control" id="otro" name="otro" placeholder="skype..." value="">
            </div>

            <?php } ?>

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $clienteDTO->getIdCliente(); ?>">
                
                <input type="hidden" name="modo" id="modo" value="<?php echo $clienteDTO->getIdCliente()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>

        </form>
    </div>
</div>