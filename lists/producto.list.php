<?php
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/productoDAO.class.php";
require "../class/productoDTO.class.php";

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??'';

$productoDTO = new productoDTO();
$productoDAO = new productoDAO($conexion);

$productos = $productoDAO->getAll($txt_busqueda);
?>


<table class="table table-striped ">
    <thead class="text_center">
        <tr>
            <th scope="row">Nombre</th>
            <th scope="row">Version</th>
            <th scope="row">Estado</th>
            <th scope="row" colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($obj = $productos->fetch_object()){
                $productoDTO->map($obj);
        ?>
        <tr>
            <td><?php echo $productoDTO->getNombre(); ?></td>
            <td><?php echo $productoDTO->getVersion(); ?></td>
            <td><?php echo $productoDTO->getEstado(); ?></td>
           
            <td>
                <a class="text-warning" href="#" onclick="abrirPagina('forms/producto.form.php','contenido','&id_producto=<?php echo $productoDTO->getId_producto();?>')"> <i class="fas fa-edit"></i> </a>
            </td>
            
            <td>
                <form action="./process/producto.process.php" id="formEliminar<?php echo $productoDTO->getId_producto();?>">

                    <input type="hidden" name="id_producto" value="<?php echo $productoDTO->getId_producto();?>"/>

                    <input type="hidden" name="modo" id="modo" value="eliminar"/>
                    
                    <a class="text-danger" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $productoDTO->getId_producto();?>'),'',`abrirPagina('lists/producto.php', 'contenido', '&txt_busqueda='+$('#id_txt_busqueda').val());`)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>
            </td>
        
        </tr>
        <?php } ?>

    </tbody>
</table>

