<?php

require '../config/conexion.php';
require '../class/conexion.class.php';
require '../class/cliente_productoDAO.class.php';
require '../class/cliente_productoDTO.class.php';
require '../class/clienteDAO.class.php';
require '../class/clienteDTO.class.php';
require "../class/servidorDTO.class.php";
require "../class/servidorDAO.class.php";
require "../class/resellerDAO.class.php";
require "../class/resellerDTO.class.php";
require "../class/productoDAO.class.php";
require "../class/productoDTO.class.php";

$id_cliente_producto = filter_input(INPUT_POST,'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT)??0;

$cliente_productoDTO = new cliente_productoDTO();
$cliente_productoDTO->loadById($id_cliente_producto,$conexion);

$clienteDAO = new clienteDAO($conexion);
$clienteDTO = new clienteDTO();
$servidorDAO = new servidorDAO($conexion);
$servidorDTO = new servidorDTO();
$resellerDAO = new resellerDAO($conexion);
$resellerDTO = new resellerDTO();
$productoDAO = new productoDAO($conexion);
$productoDTO = new productoDTO();

$clientes = $clienteDAO->getAll();
$servidores = $servidorDAO->getAllByStatus($cliente_productoDTO->getId_servidor());
$reselleres = $resellerDAO->getAll();
$productos = $productoDAO->getAllActive();

//Validacion para alerta por haber server disponibles
if($servidores->num_rows == 0 && $id_cliente_producto == 0){
?>    
    <div class=" shadow float-center m-5 p-3 alert alert-info alert-dismissible fade show " role="alert" >
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </symbol>
    </svg>
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        No hay servidores disponibles.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" tabindex="-1" onclick="abrirPagina('lists/cliente_producto.php','contenido','&txt_busqueda=');" ></button>
    </div>   

<?php
}else{
?>
    <div class="row">
        <fieldset class="bg-white shadow p-3 mb-3 bg-body rounded">
            <legend class="col-10 fs-3">  
                Servidores - clientes
            </legend>
        </fieldset>
        <div class="container-fluid p-3 me-3">
            <form class="row g-3" method="POST" action="./process/cliente_producto.process.php" onsubmit="return enviarFormulario(this,'',`abrirPagina('lists/cliente_producto.php', 'contenido', '&id_cliente_producto=<?php echo $id_cliente_producto; ?>');`);">
                
                <div class="col-md-4 mb-3 list-group">
                    <label for="id_cliente" class="form-label">Cliente</label>

                    <select name="id_cliente" aria-label="Default select example" id="id_cliente" class="form-select" required>
                        <option>Seleccione...</option>
                        <?php 
                        while($obj = $clientes->fetch_object()){
                            $clienteDTO->map($obj);
                        ?>
                        <option value="<?php echo $clienteDTO->getIdCliente(); ?>" <?php echo $clienteDTO->getIdCliente()==$cliente_productoDTO->getId_cliente()?"selected":"";?>> <?php echo $clienteDTO->getNombre(); ?></option>
                        <?php 
                        }
                        ?>
                    </select>  
                </div>

                <div class="col-md-2 mb-3 list-group">
                    <label for="id_txt_ip_docker" class="form-label">Ip docker</label>
                    <input type="text" class="form-control" id="id_txt_ip_docker" name="ip_docker" placeholder="192.168.28.81" value="<?php echo $cliente_productoDTO->getIp_docker(); ?>" required>
                </div>   

                 <div class="col-md-3 mb-3 list-group">
                    <label for="id_servidor" class="form-label">Servidor</label>

                    <select name="id_servidor" aria-label="Default select example" id="id_servidor" class="form-select" required>
                        <option>Seleccione...</option>
                        <?php 
                        while($obj = $servidores->fetch_object()){
                            $servidorDTO->map($obj);
                        ?>
                        <option value="<?php echo $servidorDTO->getId_servidor();?>" <?php echo $servidorDTO->getId_servidor()==$cliente_productoDTO->getId_servidor()?"selected":"";?>> <?php echo $servidorDTO->getIp(); ?></option>
                        <?php 
                        }
                        ?>
                    </select>  
                </div>
                    
                <div class="col-md-3 mb-3 list-group">
                    <label for="id_txt_estado" class="form-label">Estado</label>
                    <select class="form-select" aria-label="Default select example" name="estado" id="estado" required="yes">
                        <option value="activo" <?php echo $cliente_productoDTO->getEstado()=="activo"?"selected":"";?>>Activo</option>
                        <option value="demo" <?php echo $cliente_productoDTO->getEstado()=="demo"?"selected":"";?>>Demo</option>
                        <option value="suspendido" <?php echo $cliente_productoDTO->getEstado()=="suspendido"?"selected":"";?>>Suspendido</option>
                        <option value="cancelado" <?php echo $cliente_productoDTO->getEstado()=="cancelado"?"selected":"";?>>Cancelado</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3 list-group">
                    <label for="id_txt_dominio" class="form-label">Dominio</label>
                    <input type="text" class="form-control" id="id_txt_dominio" name="dominio" placeholder="sip.midominio.com" value="<?php echo $cliente_productoDTO->getDominio(); ?>">
                </div>

                <div class="col-md-2 mb-3 list-group">
                    <label for="id_txt_maxcall" class="form-label">Canales</label>
                    <input type="text" class="form-control" id="id_txt_maxcall" name="maxcall" placeholder="10" value="<?php echo $cliente_productoDTO->getMaxcall(); ?>" required>
                </div>

                <div class="col-md-3 mb-3 list-group">
                    <label for="id_producto" class="form-label">Producto</label>

                    <select name="id_producto" aria-label="Default select example" id="id_producto" class="form-select" required>
                        <option>Seleccione...</option>
                        <?php 
                        while($obj = $productos->fetch_object()){
                            $productoDTO->map($obj);
                        ?>
                        <option value="<?php echo $productoDTO->getId_producto();?> " <?php echo $productoDTO->getId_producto()==$cliente_productoDTO->getId_producto()?"selected":"";?>> <?php echo $productoDTO->getNombre()." ".$productoDTO->getVersion(); ?></option>
                        <?php 
                        }
                        ?>
                    </select>  
                </div>

                <div class="col-md-3 mb-3 list-group">
                    <label for="id_reseller" class="form-label">Reseller</label>

                    <select name="id_reseller" aria-label="Default select example" id="id_reseller" class="form-select" required>
                        <option>Seleccione...</option>
                        <?php 
                        while($obj = $reselleres->fetch_object()){
                            $resellerDTO->map($obj);
                        ?>
                        <option value="<?php echo $resellerDTO->getId_reseller(); ?>"<?php echo $resellerDTO->getId_reseller()==$cliente_productoDTO->getId_reseller()?"selected":"";?>> <?php echo $resellerDTO->getNombre(); ?></option>
                        <?php 
                        }
                        ?>
                    </select>  
                </div>
                                       
                <div class="col-md-4 mb-3 list-group">
                    <label for="id_txt_referencia" class="form-label">Referencia</label>
                    <input type="text" class="form-control" id="id_txt_referencia" name="referencia" placeholder="000656253482" value="<?php echo $cliente_productoDTO->getReferencia(); ?>" required>
                </div>

                <div class="col-md-2 mb-3 list-group">
                    <label for="id_txt_descuento" class="form-label">% Descuento</label>
                    <input type="number" step="any" class="form-control" id="id_txt_descuento" name="descuento" placeholder="50" value="<?php echo $cliente_productoDTO->getDescuento(); ?>" required>
                </div>

                <div class="col-md-3 mb-3 list-group">
                    <label for="id_txt_precio_venta" class="form-label">Precio de venta</label>
                    <input type="number" step="any" class="form-control" id="id_txt_precio_venta" name="precio_venta" placeholder="180.000" value="<?php echo $cliente_productoDTO->getPrecio_venta(); ?>" required>
                </div>

                <div class="col-md-3 mb-3 list-group">
                    <label for="id_txt_saldo" class="form-label">Saldo</label>
                    <input type="number" step="any" class="form-control" id="id_txt_saldo" name="saldo" placeholder="180.000" value="<?php echo $cliente_productoDTO->getSaldo(); ?>">
                </div>

                <div class="col-md-12 mb-3 d-flex justify-content-start align-items-end">
                    <input type="hidden" class="form-control" id="id_cliente_producto" name="id_cliente_producto" value="<?php echo $cliente_productoDTO->getId_cliente_producto(); ?>">
                    
                    <input type="hidden" name="modo" id="modo" value="<?php echo $cliente_productoDTO->getId_cliente_producto()?"editar":"crear"; ?>" />

                    <button type="submit" id="boton" name="enviar" class="btn btn-info">Guardar</button>
                </div>

            </form>
        </div>
    </div>
<?php } ?>