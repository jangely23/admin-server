<?php 

$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda',FILTER_SANITIZE_STRING)
?>
<fieldset class=" shadow p-3 mb-3  rounded bg-ligth">
    <legend class="col-10">  
        Plan del servidor
    </legend>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="form-group">
                <input class="form-control" type="text" name="txt_busqueda" id="id_txt_busqueda" placeholder="digite aqui su busqueda" value="<?php echo $txt_busqueda; ?>"/>
            </div>
        </div>
        <div class="col-12 col-md-6 display-query">
            <button type="button" class="btn btn-secondary" onclick="abrirPagina('lists/servidor_detalle.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val());">Buscar</button>
            <button type="button" class="btn btn-info text-white float-end" onclick="abrirPagina('forms/servidor_detalle.form.php','contenido','');"><i class="far fa-file-alt"></i>&nbsp;+ plan</button>
        </div>
    </div>
</fieldset>

<div class="row">
    <div id="id_div_contenido_servidor_detalle" class="p-3 table-responsive">
        <?php require 'servidor_detalle.list.php' ; ?>
    </div>
</div>