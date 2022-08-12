<?php
require '../scripts/validarSession.php';
require "../config/conexion.php";
require "../class/conexion.class.php";


//Establece fechas de facturacion para cuenta de cobro y obtiene los cliente_producto a cobrar
date_default_timezone_set('America/Bogota');
?>

<div class="row">
    <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
        <legend class="col-10 fs-3"> 
            Generar cuentas de cobro masivas
        </legend>
    </fieldset>

    <div class="container-fluid p-3 me-3">
        <form class="row g-3" method="POST" action="./../scripts/genera_envia_cuenta.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/cliente_producto.php','contenido','')`)">

            <div class="col-md-3 mb-3">
                <label for="inicio_corte" class="form-label">Fecha corte</label>
                <input type="date" class="form-control" id="inicio_corte" name="inicio_corte" value="" required="yes">
            </div>

            <div class="col-md-3 mb-3">
                <label for="fecha_pago" class="form-label">Fecha pago</label>
                <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" value="" required="yes">
            </div>

            <div class="col-md-3 mb-3">
                <label for="fecha_suspension" class="form-label">Fecha suspension</label>
                <input type="date" class="form-control" id="fecha_suspension" name="fecha_suspension" value="" required="yes">
            </div>

            <div class="form-check form-switch col-md-3 mb-3 p-3 d-flex align-items-center justify-content-center" >
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="x_minuto" value="1">
                <label class="form-check-label p-3" for="flexSwitchCheckChecked"> server X minuto</label>
            </div>

            <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
            </div>
        </form>
    </div>
</div>

