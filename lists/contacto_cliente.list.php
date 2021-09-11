<?php

require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/contacto_clienteDAO.class.php";
require "../class/contacto_clienteDTO.class.php";

$contacto_clienteDTO = new contacto_clienteDTO();
$contacto_clienteDAO = new contacto_clienteDAO($conexion);



//Inicio paginacion
$muestra = 10;
$pagina = filter_input(INPUT_POST,'pagina',FILTER_SANITIZE_NUMBER_INT)??1;

$registro_inicio = ($pagina-1) * $muestra;
$cantidad_registros = $contacto_clienteDAO->getCount($id_cliente);
$paginas = ceil($cantidad_registros/$muestra);

$datos_contacto = $contacto_clienteDAO->getAllPage($id_cliente, $registro_inicio, $muestra);
//fin paginacion
?>

<table class="table table-striped">
    <thead class="text_center">
        <tr>
            <th scope="row">Email</th>
            <th scope="row">Celular</th>
            <th scope="row" class="columna_no_indispensable">Telefono</th>
            <th scope="row" class="columna_no_indispensable">Otro</th>
            <th scope="row" colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($obj = $datos_contacto->fetch_object()){
                $contacto_clienteDTO->map($obj);
        ?>
        <tr>
            <td><?php echo $contacto_clienteDTO->getEmail(); ?></td>
            <td><?php echo $contacto_clienteDTO->getCelular(); ?></td>
            <td class="columna_no_indispensable"><?php echo $contacto_clienteDTO->getTelefono(); ?></td>
            <td class="columna_no_indispensable"><?php echo $contacto_clienteDTO->getOtro(); ?></td>
            
            <td>
                <a class="text-warning" href="#" onclick="abrirPagina('forms/contacto_cliente.form.php','contenido','&id_contacto_cliente=<?php echo $contacto_clienteDTO->getIdContactoCliente();?>')"> <i class="fas fa-edit"></i> </a>
            </td>
            
            <td>
                <form action="./process/contacto_cliente.process.php" id="formEliminar<?php echo $contacto_clienteDTO->getIdContactoCliente();?>">

                    <input type="hidden" name="id_contacto_cliente" value="<?php echo $contacto_clienteDTO->getIdContactoCliente();?>"/>

                    <input type="hidden" name="modo" id="modo" value="eliminar"/>
                    
                    <a class="text-danger" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $contacto_clienteDTO->getIdContactoCliente();?>'),'',`abrirPagina('lists/contacto_cliente.php', 'contenido', '&id_cliente=<?php echo $id_cliente;?>');`)">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </form>
            </td>
        
        </tr>
        <?php } ?>

    </tbody>
</table>

<div class="row">
    <div class="col text-secondary mt-3">
        <center> <?php echo "Página ".$pagina." de ".$paginas; ?> </center>
    </div>
</div>
<div class="row">
    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/contacto_cliente.list.php','id_div_contenido_contacto_cliente','&id_cliente=<?php echo $id_cliente;?>'+'&pagina=1')"> <i class="fas fa-fast-backward"></i> </a></li>

            <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/contacto_cliente.list.php','id_div_contenido_contacto_cliente','&id_cliente=<?php echo $id_cliente;?>'+'&pagina=<?php echo ($pagina-1);?>')"> <i class="fas fa-step-backward"></i> </a></li>

            <li class="page-item <?php echo $pagina==$paginas?'disabled':'';?>"><a class="page-link" href="#" onclick="abrirPagina('lists/contacto_cliente.list.php','id_div_contenido_contacto_cliente','&id_cliente=<?php echo $id_cliente;?>'+'&pagina=<?php echo ($pagina+1);?>')"> <i class="fas fa-step-forward"></i> </a></li>

            <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/contacto_cliente.list.php','id_div_contenido_contacto_cliente','&id_cliente=<?php echo $id_cliente;?>'+'&pagina=<?php echo $paginas;?>')"> <i class="fas fa-fast-forward"></i> </a></li>
        </ul>
    </nav>
</div>