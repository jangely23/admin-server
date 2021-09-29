<?php
$id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT)??0;
?>
<fieldset class=" shadow p-3 mb-3  rounded bg-ligth">
    <div class="col-9 col-md-9">
        <legend >  
            Modulo servidor - cliente
        </legend>
    </div>
    <div class="col-3 col-md-3 float-end">
        <button type="button" class="btn btn-info text-white float-end" onclick="abrirPagina('forms/cliente_producto_modulo.form.php','contenido','&id_cliente_producto=<?php echo $id_cliente_producto;?>');"> <i class="fas fa-stream"></i>&nbsp;+</button>
    </div>
</fieldset>

<div class="row">
    <div id="id_div_contenido_cliente_producto_modulo " class="p-3 table-responsive">
        <?php require 'cliente_producto_modulo.list.php' ; ?>
    </div>
</div>