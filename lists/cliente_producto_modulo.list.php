<?php
require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/cliente_producto_moduloDAO.class.php';
require '../class/cliente_producto_moduloDTO.class.php';
require "../class/moduloDTO.class.php";
require "../class/moduloDAO.class.php";

$id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT)??0;

$cliente_producto_moduloDAO = new cliente_producto_moduloDAO($conexion);
$cliente_producto_moduloDTO = new cliente_producto_moduloDTO();

$moduloDTO = new moduloDTO();

$cliente_producto_modulos = $cliente_producto_moduloDAO->getAll($id_cliente_producto);
?>

<table class="table table-striped">
    <thead class="text-center">
        <tr>
            <th scope="row">Nombre</th>
            <th scope="row">Proveedor</th>
            <th scope="row">Acción</th>                    
        </tr>
    </thead>
    <tbody>
        <?php 
            while ($obj = $cliente_producto_modulos->fetch_object()){
            $cliente_producto_moduloDTO->map($obj); 
            $moduloDTO->loadById($cliente_producto_moduloDTO->getId_modulo(), $conexion);
        ?>

        <tr>
            <td><?php echo $moduloDTO->getNombre(); ?></td>
            <td><?php echo $moduloDTO->getProveedor(); ?></td>
          
            <td class="text-center">
                <form action="./process/cliente_producto_modulo.process.php" id="formEliminar<?php echo $cliente_producto_moduloDTO->getId_cliente_producto_modulo();?>">
                    <input type="hidden" name="id_cliente_producto_modulo" value="<?php echo $cliente_producto_moduloDTO->getId_cliente_producto_modulo();?>"/>

                    <input type="hidden" name="id_modulo" value="<?php echo $cliente_producto_moduloDTO->getId_modulo();?>"/>
                    <input type="hidden" name="id_cliente_producto" value="<?php echo $cliente_producto_moduloDTO->getId_cliente_producto();?>"/>
                    
                    <input type="hidden" name="modo" id="modo" value="eliminar"/>

                    <a class="text-danger " onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $cliente_producto_moduloDTO->getId_cliente_producto_modulo();?>'),'',`abrirPagina('lists/cliente_producto_modulo.php', 'contenido', '&id_cliente_producto=<?php echo $id_cliente_producto; ?>');`);">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </form>    
            </td>

        </tr>

        <?php
            }
        ?>
    </tbody>
</table>
