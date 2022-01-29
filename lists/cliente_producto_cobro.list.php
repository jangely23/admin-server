<?php
require '../scripts/validarSession.php'; 
require "../config/conexion.php";
require "../class/conexion.class.php";
require "../class/cliente_producto_cobroDAO.class.php";
require "../class/cliente_producto_cobroDTO.class.php";

$cliente_producto_cobroDTO = new cliente_producto_cobroDTO();
$cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);

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
            <th scope="row">#</th>
            <th scope="row">Cuenta</th>
            <th scope="row" class="columna_no_indispensable">Valor</th>
            <th scope="row" class="columna_no_indispensable">Fecha Pago</th>
            <th scope="row" class="columna_no_indispensable">Estado</th>
            <th scope="row" colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($obj = $datos_cobro->fetch_object()){
                $cliente_producto_cobroDTO->map($obj);
        ?>
        <tr>
            <td><?php echo $cliente_producto_cobroDTO->getNumero_cuenta(); ?></td>
            <td><?php echo $cliente_producto_cobroDTO->getCuenta_cobro(); ?></td>
            <td class="columna_no_indispensable"><?php echo $cliente_producto_cobroDTO->getValor(); ?></td>
            <td class="columna_no_indispensable"><?php echo $cliente_producto_cobroDTO->getFecha_pago(); ?></td>
            <td class="columna_no_indispensable"><?php echo $cliente_producto_cobroDTO->getEstado(); ?></td>
            
            <?php if($cliente_producto_cobroDTO->getEstado() == "generada"){ ?>
                <td><a class="text-success" href="../public/pdf/<?php echo $cliente_producto_cobroDTO->getCuenta_cobro();?>" target="_blank"><i class="fas fa-download"></i></a></td>
            <?php } ?>
            <td>
                <form action="./process/cliente_producto_cobro.process.php" id="formEliminar<?php echo $cliente_producto_cobroDTO->getId_cliente_producto_cobro();?>">

                    <input type="hidden" name="id_cliente_producto_cobro" value="<?php echo $cliente_producto_cobroDTO->getId_cliente_producto_cobro();?>"/>

                    <input type="hidden" name="cuenta_cobro" value="<?php echo $cliente_producto_cobroDTO->getCuenta_cobro();?>"/>

                    <input type="hidden" name="modo" id="modo" value="eliminar"/>

                    <a class="text-danger" onclick="enviarFormulario(document.getElementById('formEliminar<?php echo $cliente_producto_cobroDTO->getId_cliente_producto_cobro();?>'),'',`abrirPagina('lists/cliente_producto_cobro.php', 'contenido', '&id_cliente_producto=<?php echo $id_cliente_producto;?>');`)">
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
            <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_cobro.php','contenido','&id_cliente_producto=<?php echo $id_cliente_producto;?>'+'&pagina=1')"> <i class="fas fa-fast-backward"></i> </a></li>

            <li class="page-item <?php echo $pagina==1?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_cobro.php','contenido','&id_cliente_producto=<?php echo $id_cliente_producto;?>'+'&pagina=<?php echo ($pagina-1);?>')"> <i class="fas fa-step-backward"></i> </a></li>

            <li class="page-item <?php echo $pagina==$paginas?'disabled':'';?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_cobro.php','contenido','&id_cliente_producto=<?php echo $id_cliente_producto;?>'+'&pagina=<?php echo ($pagina+1);?>')"> <i class="fas fa-step-forward"></i> </a></li>

            <li class="page-item <?php echo $pagina==$paginas?'disabled':''; ?>"><a class="page-link" href="#" onclick="abrirPagina('lists/cliente_producto_cobro.php','contenido','&id_cliente_producto=<?php echo $id_cliente_producto;?>'+'&pagina=<?php echo $paginas;?>')"> <i class="fas fa-fast-forward"></i> </a></li>
        </ul>
    </nav>
</div>