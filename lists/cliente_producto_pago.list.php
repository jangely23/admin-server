<?php
require '../scripts/validarSession.php'; 
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/cliente_producto_pagoDAO.class.php";
require "../class/cliente_producto_pagoDTO.class.php";

$cliente_producto_pagoDTO = new cliente_producto_pagoDTO();
$cliente_producto_pagoDAO = new cliente_producto_pagoDAO($conexion);

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??"";
$id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT)??0;


//Inicio paginacion
$muestra = 10;
$pagina = filter_input(INPUT_POST,'pagina',FILTER_SANITIZE_NUMBER_INT)??1;

$registro_inicio = ($pagina-1) * $muestra;
$cantidad_registros = $cliente_producto_pagoDAO->getCount($txt_busqueda, $id_cliente_producto);
$paginas = ceil($cantidad_registros/$muestra);

$datos_pago = $cliente_producto_pagoDAO->getAllPage($txt_busqueda, $id_cliente_producto, $registro_inicio, $muestra);
//fin paginacion
?>


<table class="table table-striped ">
    <thead class="text_center">
        <tr>
            <th scope="row">Fecha pago</th>
            <th scope="row">Medio pago</th>
            <th scope="row">Valor</th>
            <th scope="row">Soporte</th>
            <th scope="row">Validacion</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($obj = $datos_pago->fetch_object()){
                $cliente_producto_pagoDTO->map($obj);
        ?>
        <tr>
            <td><?php echo $cliente_producto_pagoDTO->getFecha_pago(); ?></td>
            <td><?php echo $cliente_producto_pagoDTO->getMedio_pago(); ?></td>
            <td><?php echo $cliente_producto_pagoDTO->getValor(); ?></td>
            <td><?php echo $cliente_producto_pagoDTO->getSoporte(); ?></td>
            <td><?php echo $cliente_producto_pagoDTO->getValidacion(); ?></td>
                 
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
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_pago.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=1')"><i class="fas fa-fast-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_pago.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina-1);?>')"><i class="fas fa-step-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_pago.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina+1);?>')"><i class="fas fa-step-forward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_pago.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo $paginas;?>')"><i class="fas fa-fast-forward"></i></a></li>
        </ul>
    </nav> 
</div>