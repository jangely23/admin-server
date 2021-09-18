<?php
$txt_busqueda = filter_input(INPUT_POST,'txt_busqueda', FILTER_SANITIZE_STRING);
?>


<fieldset class=" shadow p-3 mb-3  rounded bg-ligth">
    <legend class="col-9">  
        Servidores
    </legend>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <input class="form-control" type="text" name="txt_busqueda" id="id_txt_busqueda" placeholder="digite aqui su busqueda" value="<?php echo $txt_busqueda; ?>"/>
            </div>
            <button  type="button" class="btn btn-secondary" onclick="abrirPagina('lists/servidor.php','contenido','&txt_busqueda='+$('#id_txt_busqueda').val());">Buscar</button>
        </div>
        <div class="col ">

            <button type="button" class=" btn btn-secondary ms-1 text-white float-end" onclick="abrirPagina('./lists/servidor_detalle.php','contenido','');"><i class="far fa-file-alt"></i>&nbsp;planes</button>

            <button type="button" class=" btn btn-info text-white float-end" onclick="abrirPagina('forms/servidor.form.php','contenido','');"> <i class="fas fa-server"></i>&nbsp;+ server</button>
        </div>
    </div>
</fieldset>

<div class="row">
    <div id="id_div_contenido_servidor " class="p-3 col">
        <?php require 'servidor.list.php' ; ?>
    </div>
</div>