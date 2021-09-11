<?php
require "../config/conexion.php";
require "../class/conexion.class.php"; 
require "../class/servidor_detalleDAO.class.php"; 
require "../class/servidor_detalleDTO.class.php"; 

$servidor_detalleDTO = new servidor_detalleDTO();
$servidor_detalleDAO = new servidor_detalleDAO($conexion);

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??'';

//Inicio paginacion
$muestra = 10;
$pagina = filter_input(INPUT_POST,'pagina',FILTER_SANITIZE_NUMBER_INT)??1;
$registro_inicio = ($pagina-1)*$muestra;
$cantidad_registros = $servidor_detalleDAO->getCount($txt_busqueda);
$paginas = ceil($cantidad_registros/$muestra);

$servidor_detalles = $servidor_detalleDAO->getAllPage($txt_busqueda, $registro_inicio, $muestra);
//Fin paginacion
?>

<table class="table table-striped">
    <thead class="text_center">
        <tr>
            <th scope="row">Plan</th>
            <th scope="row" class="columna_no_indispensable">Ram</th>
            <th scope="row" class="columna_no_indispensable">Disco</th>
            <th scope="row" class="columna_no_indispensable">Procesador</th>
            <th scope="row">Datacenter</th>
            <th scope="row" class="columna_no_indispensable">Raid</th>
            <th scope="row">Costo</th>
            <th scope="row" colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>     
        <?php 
        while($obj = $servidor_detalles->fetch_object()){
        $servidor_detalleDTO->map($obj);
        ?>

        <tr>
            <td><?php echo $servidor_detalleDTO->getPlan_servidor(); ?></td>
            <td class="columna_no_indispensable"><?php echo $servidor_detalleDTO->getRam() ?></td>
            <td class="columna_no_indispensable"><?php echo $servidor_detalleDTO->getDisco() ?></td>
            <td class="columna_no_indispensable"><?php echo $servidor_detalleDTO->getProcesador() ?></td>
            <td><?php echo $servidor_detalleDTO->getDatacenter() ?></td>
            <td class="columna_no_indispensable"><?php echo $servidor_detalleDTO->getRaid() ?></td>
            <td><?php echo $servidor_detalleDTO->getCosto()." ".$servidor_detalleDTO->getMoneda(); ?></td>
            <td>
                <a class="text-warning" href="#" onclick="abrirPagina('forms/servidor_detalle.form.php','contenido','&id_servidor_detalle=<?php echo $servidor_detalleDTO->getId_servidor_detalle();?>');"><i class="fas fa-edit"></i></a>
            </td>
            <td>
                <form action="./process/servidor_detalle.process.php" id="formEliminar<?php echo $servidor_detalleDTO->getId_servidor_detalle();?>">

                    <input type="hidden" name='id_servidor_detalle' value="<?php echo $servidor_detalleDTO->getId_servidor_detalle();?>">

                    <input type="hidden" name="modo" id="modo" value="eliminar">

                    <a class="text-danger" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $servidor_detalleDTO->getId_servidor_detalle();?>'),'', `abrirPagina('./lists/servidor_detalle.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val());`);">
                        <i class="fas fa-trash-alt"></i>
                    </a>

                </form>
            </td>
        </tr>
        
        <?php }?>    
    </tbody>
</table>

<!-- Paginacion -->
<div class="row ">
    <div class="col text-secondary mt-3">
        <center><?php echo "Página ".$pagina." de ".$paginas;?> </center>
    </div>
</div>
<div class="row ">
    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
        <ul class="pagination">
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor_detalle.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=1')"><i class="fas fa-fast-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor_detalle.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina-1);?>')"><i class="fas fa-step-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor_detalle.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina+1);?>')"><i class="fas fa-step-forward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor_detalle.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo $paginas;?>')"><i class="fas fa-fast-forward"></i></a></li>
        </ul>
    </nav> 
</div>
   




