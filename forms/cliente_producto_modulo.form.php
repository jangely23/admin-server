<?php
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/cliente_producto_moduloDAO.class.php";
require "../class/cliente_producto_moduloDTO.class.php";
require "../class/cliente_productoDAO.class.php";
require "../class/cliente_productoDTO.class.php";
require "../class/moduloDAO.class.php";
require "../class/moduloDTO.class.php";

$id_cliente_producto_modulo = filter_input(INPUT_POST,'id_cliente_producto_modulo',FILTER_SANITIZE_NUMBER_INT)??0;
$id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT)??0;

$cliente_producto_moduloDTO = new cliente_producto_moduloDTO();
$cliente_producto_moduloDTO->loadById($id_cliente_producto_modulo,$conexion);

$moduloDTO = new moduloDTO();
$moduloDAO = new moduloDAO($conexion); 
$cliente_productoDTO = new cliente_productoDTO();
$cliente_productoDAO = new cliente_productoDAO($conexion); 

$cliente_producto = $cliente_productoDAO->getById($id_cliente_producto);
$modulos = $moduloDAO->getAll();

?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3">  
            Servidores - clientes
        </legend>
    </fieldset>
    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./process/cliente_producto_modulo.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/cliente_producto_modulo.php', 'contenido', '&id_cliente_producto_modulo=<?php echo $id_cliente_producto_modulo; ?>');`);">
            
            <?php 
                while($obj = $modulos->fetch_object()){
                    $moduloDTO->map($obj);
            ?>
            <div class="col-md-12 m-3 form-check">
                <input class="form-check-input" type="checkbox" name="id_modulo[]" value="<?php echo $moduloDTO->getId_modulo(); ?>" id="flexCheckDefault" <?php echo $moduloDTO->getId_modulo()==$cliente_producto_moduloDTO->getId_modulo()?"checked":""; ?>>

                <label class="form-check-label" for="flexCheckDefault"><?php echo $moduloDTO->getNombre(); ?></label>
            </div>
            <?php
                }
            ?>

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <input type="hidden" class="form-control" id="id_cliente_producto" name="id_cliente_producto" value="<?php echo $id_cliente_producto; ?>">
                
                <input type="hidden" name="modo" id="modo" value="<?php echo $cliente_producto_moduloDTO->getId_cliente_producto_modulo()?"editar":"crear"; ?>" />

                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>

        </form>
    </div>
</div>