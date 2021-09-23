<?php
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/moduloDTO.class.php";
require "../class/moduloDAO.class.php";

$moduloDTO = new moduloDTO();
$moduloDAO = new moduloDAO($conexion);

$modulos = $moduloDAO->getAll();
?>

<table class="table table-striped ">
    <thead class="text_center">
        <tr>
            <th scope="row">Nombre</th>
            <th scope="row">Proveedor</th>
            <th scope="row" colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($obj = $modulos->fetch_object()){
                $moduloDTO->map($obj);
        ?>
        <tr>
            <td><?php echo $moduloDTO->getNombre(); ?></td>
            <td><?php echo $moduloDTO->getProveedor(); ?></td>
           
            <td>
                <a class="text-warning" href="#" onclick="abrirPagina('forms/modulo.form.php','contenido','&id_modulo=<?php echo $moduloDTO->getId_modulo();?>')"> <i class="fas fa-edit"></i> </a>
            </td>
            
            <td>
                <form action="./process/modulo.process.php" id="formEliminar<?php echo $moduloDTO->getId_modulo();?>">

                    <input type="hidden" name="id_modulo" value="<?php echo $moduloDTO->getId_modulo();?>"/>

                    <input type="hidden" name="modo" id="modo" value="eliminar"/>
                    
                    <a class="text-danger" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $moduloDTO->getId_modulo();?>'),'',`abrirPagina('lists/modulo.php', 'contenido', '');`)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>
            </td>
        
        </tr>
        <?php } ?>

    </tbody>
</table>

