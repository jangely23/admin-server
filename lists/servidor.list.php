<?php 
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/servidorDTO.class.php";
require "../class/servidorDAO.class.php";
require "../class/servidor_detalleDTO.class.php";
require "../class/servidor_detalleDAO.class.php";

$servidorDTO = new servidorDTO();
$servidorDAO = new servidorDAO($conexion);

$servidor_detalleDTO = new servidor_detalleDTO();

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??"";

//Inicio paginacion
$muestra = 10;
$pagina = filter_input(INPUT_POST,'pagina',FILTER_SANITIZE_NUMBER_INT)??1;

$registro_inicio = ($pagina-1) * $muestra;
$cantidad_registros = $servidorDAO->getCount($txt_busqueda);
$paginas = ceil($cantidad_registros / $muestra);

$servidores = $servidorDAO->getAllPage($txt_busqueda, $registro_inicio, $muestra);

//Fin paginacion
?>
<script src="../public/js/deshabilitar.js"></script>
<table class="table table-striped">
    <thead class="text_center">
        <tr>
            <th scope="row">IP</th>
            <th scope="row" class="columna_no_indispensable">Tipo</th>
            <th scope="row">Estado</th>
            <th scope="row" class="columna_no_indispensable">Pago</th>
            <th scope="row" class="columna_no_indispensable">Nombre</th>
            <th scope="row" class="columna_no_indispensable">Observacion</th>
            <th scope="row" colspan="3">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($obj = $servidores->fetch_object()){
            $servidorDTO->map($obj);
            $servidor_detalleDTO->loadById($servidorDTO->getId_servidor_detalle(), $conexion);
        ?>
        <tr>
            <td class="botonDeshabilitar"><?php echo $servidorDTO->getIp(); ?></td>
            <td class="columna_no_indispensable botonDeshabilitar"><?php echo $servidorDTO->getTipo()." - ".$servidor_detalleDTO->getPlan_servidor();;?></td>
            <td class="estadoClienteProducto botonDeshabilitar"><?php echo $servidorDTO->getEstado();?></td>
            <td class="columna_no_indispensable botonDeshabilitar"><?php echo $servidorDTO->getPeriodicidad_pago();?></td>
            <td class="columna_no_indispensable botonDeshabilitar"><?php echo $servidorDTO->getNombre();?></td>
            <td class="columna_no_indispensable botonDeshabilitar"><?php echo $servidorDTO->getObservacion();?></td>
            <td>
                <a class="text-warning botonDeshabilitar" href="#" onclick="abrirPagina('forms/servidor.form.php','contenido','&id_servidor=<?php echo $servidorDTO->getId_servidor();?>');"><i class="fas fa-edit"></i></a>
            </td>
            <td>
                <form action="./process/servidor.process.php" id="formEliminar<?php echo $servidorDTO->getId_servidor();?>">
                    <input type="hidden" name='id_servidor' value="<?php echo $servidorDTO->getId_servidor();?>">

                    <input type="hidden" name='modo' value='eliminar'>

                    <a class="text-danger botonDeshabilitar" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $servidorDTO->getId_servidor();?>'),'',`abrirPagina('lists/servidor.php', 'contenido', '&txt_busqueda='+$('#id_txt_busqueda').val());`)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>
            </td>

        </tr>
        <?php } ?>
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
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=1')"><i class="fas fa-fast-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina-1);?>')"><i class="fas fa-step-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina+1);?>')"><i class="fas fa-step-forward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/servidor.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo $paginas;?>')"><i class="fas fa-fast-forward"></i></a></li>
        </ul>
    </nav> 
</div>