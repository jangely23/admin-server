<?php
require '../scripts/validarSession.php'; 
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/resellerDAO.class.php";
require "../class/resellerDTO.class.php";

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??'';

$resellerDTO = new resellerDTO();
$resellerDAO = new resellerDAO($conexion);

$resellers = $resellerDAO->getAll($txt_busqueda);
?>

<table class="table table-striped ">
    <thead class="text_center">
        <tr>
            <th scope="row">Nombre</th>
            <th scope="row">Email</th>
            <th scope="row">Celular</th>
            <th scope="row" colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($obj = $resellers->fetch_object()){
                $resellerDTO->map($obj);
        ?>
        <tr>
            <td><?php echo $resellerDTO->getNombre(); ?></td>
            <td><?php echo $resellerDTO->getEmail(); ?></td>
            <td><?php echo $resellerDTO->getCelular(); ?></td>
           
            <td>
                <a class="text-warning" href="#" onclick="abrirPagina('forms/reseller.form.php','contenido','&id_reseller=<?php echo $resellerDTO->getId_reseller();?>')"> <i class="fas fa-edit"></i> </a>
            </td>
            
            <td>
                <form action="./process/reseller.process.php" id="formEliminar<?php echo $resellerDTO->getId_reseller();?>">

                    <input type="hidden" name="id_reseller" value="<?php echo $resellerDTO->getId_reseller();?>"/>

                    <input type="hidden" name="modo" id="modo" value="eliminar"/>
                    
                    <a class="text-danger" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $resellerDTO->getId_reseller();?>'),'',`abrirPagina('lists/reseller.php', 'contenido', '&txt_busqueda='+$('#id_txt_busqueda').val());`)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>
            </td>
        
        </tr>
        <?php } ?>

    </tbody>
</table>
