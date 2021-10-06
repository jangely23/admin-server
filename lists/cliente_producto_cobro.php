<?php
$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda', FILTER_SANITIZE_STRING);
?>

<fieldset class=" shadow p-3 mb-3  rounded bg-ligth">
    <legend class="col-10">  
        Cuentas de cobro
    </legend>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input class="form-control" type="text" name="txt_busqueda" id="id_txt_busqueda" placeholder="digite aqui su busqueda" value="<?php echo $txt_busqueda; ?>"/>
            </div>
        </div>
        <div class="col-12 col-md-6 display-query">
            <button type="button" class="btn btn-secondary" onclick="abrirPagina('lists/cliente_producto_cobro.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val());">Buscar</button>
        </div>
    </div>
</fieldset>

<div class="row">
    <div id="id_div_contenido_cliente_producto " class="p-3 table-responsive">
        <?php require 'cliente_producto_cobro.list.php' ; ?>        
    </div>
</div>