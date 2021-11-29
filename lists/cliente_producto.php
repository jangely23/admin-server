<?php

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda', FILTER_SANITIZE_STRING);
?>

<fieldset class=" shadow p-3 mb-3  rounded bg-ligth">
    <legend class="col-10">  
        Ventas servidores - clientes
    </legend>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input class="form-control" type="text" name="txt_busqueda" id="id_txt_busqueda" placeholder="digite aqui su busqueda" value="<?php echo $txt_busqueda; ?>"/>
            </div>
        </div>
        <div class="col-12 col-md-6 display-query">
            <button type="button" class="btn btn-secondary" onclick="abrirPagina('lists/cliente_producto.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val());">Buscar</button>
            <button type="button" class="btn btn-info text-white float-end" onclick="abrirPagina('forms/cliente_producto.form.php','contenido','');"> <i class="fas fa-user-plus"></i>&nbsp; venta</button>
        </div>
    </div>
</fieldset>

<div class="row">
    <div id="id_div_contenido_cliente_producto " class="pt-3 table-responsive">
        <?php require 'cliente_producto.list.php' ; ?>
    </div>
</div>