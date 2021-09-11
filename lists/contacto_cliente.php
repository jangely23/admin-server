<?php $id_cliente = filter_input(INPUT_POST,'id_cliente',FILTER_SANITIZE_NUMBER_INT); ?>
<fieldset class=" shadow p-3 mb-3  rounded bg-ligth d-flex align-items-center">
    <legend class="col-11">  
        Datos de contacto cliente
    </legend>
    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-info text-white float-end" onclick="abrirPagina('forms/contacto_cliente.form.php','contenido','&id_cliente=<?php  echo $id_cliente;?>');"> <i class="fas fa-phone-alt"></i></button>
        </div>
    </div>
</fieldset>

<div class="row">
    <div id="id_div_contenido_contacto_cliente" class="p-3 col">
        <?php require 'contacto_cliente.list.php' ; ?>
    </div>
</div>