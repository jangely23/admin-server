<?php 
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/contacto_clienteDAO.class.php';
require '../class/contacto_clienteDTO.class.php';

$id_contacto_cliente = filter_input(INPUT_POST,'id_contacto_cliente',FILTER_SANITIZE_NUMBER_INT)??0;
$id_cliente = filter_input(INPUT_POST,'id_cliente',FILTER_SANITIZE_NUMBER_INT);

$contacto_clienteDTO = new contacto_clienteDTO();
$contacto_clienteDTO->loadById($id_contacto_cliente, $conexion);

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Datos contacto cliente
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/contacto_cliente.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/contacto_cliente.php','contenido','&id_cliente=<?php echo $id_cliente;?>')`)">

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electronico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="corre@correo.com" value="<?php echo $contacto_clienteDTO->getEmail();?>" required="yes">
            </div> 


            <div class="col-md-3 mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="number" class="form-control" id="celular" name="celular" value="<?php echo $contacto_clienteDTO->getCelular();?>" required="yes" placeholder="573009120695">
            </div>

            <div class="col-md-3 mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="number" class="form-control" id="telefono" name="telefono" value="<?php echo $contacto_clienteDTO->getTelefono();?>" placeholder="5782771207">
            </div>

            <div class="col-md-12 mb-3">
                <label for="otro" class="form-label">Otra informacion</label>
                <input type="text" class="form-control" id="otro" name="otro" placeholder="skype..." value="<?php echo $contacto_clienteDTO->getOtro();?>">
            </div>

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $id_cliente; ?>">

                <input type="hidden" class="form-control" id="id_contacto_cliente" name="id_contacto_cliente" value="<?php echo $contacto_clienteDTO->getIdContactoCliente(); ?>">   

                <input type="hidden" name="modo" id="modo" value="<?php echo $contacto_clienteDTO->getIdContactoCliente()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>
        </form>
    </div>
</div>

