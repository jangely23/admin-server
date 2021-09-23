<?php

require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/cliente_productoDAO.class.php';
require '../class/cliente_productoDTO.class.php';
require '../class/clienteDAO.class.php';
require '../class/clienteDTO.class.php';
require "../class/servidorDTO.class.php";
require "../class/servidorDAO.class.php";
require "../class/resellerDAO.class.php";
require "../class/resellerDTO.class.php";
require "../class/productoDAO.class.php";
require "../class/productoDTO.class.php";

$cliente_productoDAO = new cliente_productoDAO($conexion);
$cliente_productoDTO = new cliente_productoDTO();

$clienteDTO = new clienteDTO();
$servidorDTO = new servidorDTO();
$resellerDTO = new resellerDTO();
$productoDTO = new productoDTO();

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??"";

//Inicio Paginacion

$muestra = 10;
$pagina = filter_input(INPUT_POST,'pagina',FILTER_SANITIZE_NUMBER_INT)??1;

$registroInicio = ($pagina-1) * $muestra;
$cantidadRegistros = $cliente_productoDAO->getCount($txt_busqueda);
$paginas = ceil($cantidadRegistros/$muestra);

$cliente_productos = $cliente_productoDAO->getAllPage($txt_busqueda, $registroInicio, $muestra);

//Fin paginacion

?>
<table class="table table-striped">
    <thead class="text-center">
        <tr>
            <th scope="row">Cliente</th>
            <th scope="row">IP</th>
            <th scope="row">Dominio</th>
            <th scope="row">Estado</th>
            <th scope="row">Producto</th>
            <th scope="row" class="columna_no_indispensable">Canales</th>
            <th scope="row" class="columna_no_indispensable">Ref. Pago</th>
            <th scope="row" class="columna_no_indispensable">Reseller</th>
            <th scope="row" colspan="3">Acciones</th>                    
        </tr>
    </thead>
    <tbody>
        <?php 
            while ($obj = $cliente_productos->fetch_object()){
            $cliente_productoDTO->map($obj); 
            $clienteDTO->loadById($cliente_productoDTO->getId_cliente(), $conexion);
            $servidorDTO->loadById($cliente_productoDTO->getId_servidor(), $conexion);
            $resellerDTO->loadById($cliente_productoDTO->getId_reseller(), $conexion);
            $productoDTO->loadById($cliente_productoDTO->getId_producto(), $conexion);
        ?>

        <tr>
            <td> <?php echo $clienteDTO->getNombre(); ?></td>
            <td> <?php echo $servidorDTO->getIp(); ?></td>
            <td> <?php echo $cliente_productoDTO->getDominio(); ?></td>
            <td> <?php echo $cliente_productoDTO->getEstado(); ?></td>
            <td> <?php echo $productoDTO->getNombre()." ".$productoDTO->getVersion(); ?></td>
            <td class="columna_no_indispensable"> <?php $cliente_productoDTO->getMaxcall(); ?></td>
            <td class="columna_no_indispensable"> <?php echo $cliente_productoDTO->getReferencia(); ?></td>
            <td class="columna_no_indispensable"> <?php echo $resellerDTO->getNombre(); ?></td>

            <td><a class="text-warning" href="#" onclick="abrirPagina('forms/cliente_producto.form.php','contenido','&id_cliente_producto=<?php echo $cliente_productoDTO->getId_cliente_producto();?>')"><i class="fas fa-edit"></i></a></td>
            <td>
                <form action="./process/cliente_producto.process.php" id="formEliminar<?php echo $cliente_productoDTO->getId_cliente_producto();?>">
                    <input type="hidden" name="id_cliente_producto" value="<?php echo $cliente_productoDTO->getId_cliente_producto();?>"/>

                    <input type="hidden" name="id_servidor" value="<?php echo $cliente_productoDTO->getId_servidor();?>"/>
                    
                    <input type="hidden" name="modo" id="modo" value="eliminar"/>

                    <a class="text-danger" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $cliente_productoDTO->getId_cliente_producto();?>'),'',`abrirPagina('lists/cliente_producto.php', 'contenido', '&txt_busqueda='+$('#id_txt_busqueda').val());`);">
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

<!-- Paginacion -->
<div class="row ">
    <div class="col text-secondary mt-3">
        <center><?php echo "Página ".$pagina." de ".$paginas;?> </center>
    </div>
</div>
<div class="row ">
    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
        <ul class="pagination">
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','id_div_contenido_cliente','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=1')"><i class="fas fa-fast-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','id_div_contenido_cliente','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina-1);?>')"><i class="fas fa-step-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','id_div_contenido_cliente','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina+1);?>')"><i class="fas fa-step-forward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','id_div_contenido_cliente','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo $paginas;?>')"><i class="fas fa-fast-forward"></i></a></li>
        </ul>
    </nav> 
</div>
   




