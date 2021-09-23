<fieldset class=" shadow p-3 mb-3  rounded bg-ligth">
    <div class="col-9 col-md-9">
        <legend >  
            Modulo
        </legend>
    </div>
    <div class="col-3 col-md-3 float-end">
        <button type="button" class="btn btn-info text-white float-end" onclick="abrirPagina('forms/modulo.form.php','contenido','');"> <i class="fas fa-stream"></i>&nbsp;+ modulo</button>
    </div>
</fieldset>

<div class="row">
    <div id="id_div_contenido_modulo " class="p-3 table-responsive">
        <?php require 'modulo.list.php' ; ?>
    </div>
</div>