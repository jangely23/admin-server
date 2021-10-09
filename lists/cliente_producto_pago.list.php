<?php

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
$cantidad_registros = $cliente_producto_cobroDAO->getCount($txt_busqueda, $id_cliente_producto);
$paginas = ceil($cantidad_registros/$muestra);

$datos_cobro = $cliente_producto_cobroDAO->getAllPage($txt_busqueda, $id_cliente_producto, $registro_inicio, $muestra);
//fin paginacion
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

