<?php

require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/clienteDAO.class.php';
require '../class/clienteDTO.class.php';

$clienteDAO = new clienteDAO($conexion);
$clienteDTO = new clienteDTO();

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)??"";

//Inicio Paginacion

$muestra = 10;
$pagina = filter_input(INPUT_POST,'pagina',FILTER_SANITIZE_NUMBER_INT)??1;

$registroInicio = ($pagina-1) * $muestra;
$cantidadRegistros = $clienteDAO->getCount($txt_busqueda);
$paginas = ceil($cantidadRegistros/$muestra);

$clientes = $clienteDAO->getAllPage($txt_busqueda, $registroInicio, $muestra);

//Fin paginacion

?>
<script src="../public/js/deshabilitar.js"></script>

<table class="table table-striped">
    <thead class="text-center">
        <tr>
            <th class="columna_no_indispensable" scope="row">CC-NIT</th>
            <th scope="row">Nombre</th>
            <th scope="row">Estado</th>
            <th class="columna_no_indispensable" scope="row">Administrador</th>
            <th class="columna_no_indispensable" scope="row">Dirección</th>
            <th scope="row" colspan="3">Acciones</th>                    
        </tr>
    </thead>
    <tbody>
        <?php 
            while ($obj = $clientes->fetch_object()){
            $clienteDTO->map($obj); 
        ?>

        <tr>
            <td class="columna_no_indispensable botonDeshabilitar"><?php echo $clienteDTO->getCcNit(); ?></td>
            <td class="botonDeshabilitar"><?php echo $clienteDTO->getNombre(); ?></td>
            <td class="estadoClienteProducto botonDeshabilitar"><?php echo $clienteDTO->getEstado(); ?></td>          
            <td class="columna_no_indispensable botonDeshabilitar"><?php echo $clienteDTO->getAdministrador(); ?></td>
            <td class="columna_no_indispensable botonDeshabilitar"><?php echo $clienteDTO->getDireccion(); ?></td>

            <td><a class="text-success botonDeshabilitar" href="#" onclick="abrirPagina('lists/contacto_cliente.php','contenido','&id_cliente=<?php echo $clienteDTO->getIdCliente();?>')"><i class="fas fa-phone-square-alt"></i></a></td>
            <td><a class="text-warning botonDeshabilitar" href="#" onclick="abrirPagina('forms/cliente.form.php','contenido','&id_cliente=<?php echo $clienteDTO->getIdCliente();?>')"><i class="fas fa-edit"></i></a></td>
            <td>
                <form action="./process/cliente.process.php" id="formEliminar<?php echo $clienteDTO->getIdCliente();?>">
                    <input type="hidden" name="id_cliente" value="<?php echo $clienteDTO->getIdCliente();?>"/>
                    
                    <input type="hidden" name="modo" id="modo" value="eliminar"/>

                    <a class="text-danger botonDeshabilitar" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $clienteDTO->getIdCliente();?>'),'',`abrirPagina('lists/cliente.php', 'contenido', '&txt_busqueda='+$('#id_txt_busqueda').val());`);">
                        <i class="fas fa-trash-alt"></i>
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
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=1')"><i class="fas fa-fast-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina-1);?>')"><i class="fas fa-step-backward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo ($pagina+1);?>')"><i class="fas fa-step-forward"></i></a></li>
        <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val()+'&pagina=<?php echo $paginas;?>')"><i class="fas fa-fast-forward"></i></a></li>
        </ul>
    </nav> 
</div>
   




