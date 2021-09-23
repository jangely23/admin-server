<?php 
class cliente_productoCOORDINATOR extends conexion{
    function __construct($conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $id_servidor = filter_input(INPUT_POST, 'id_servidor',FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_input(INPUT_POST, 'id_cliente',FILTER_SANITIZE_NUMBER_INT);
        $id_producto = filter_input(INPUT_POST, 'id_producto',FILTER_SANITIZE_NUMBER_INT);
        $id_reseller = filter_input(INPUT_POST, 'id_reseller',FILTER_SANITIZE_NUMBER_INT);
        $ip_docker = filter_input(INPUT_POST, 'ip_docker',FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST, 'estado',FILTER_SANITIZE_STRING);
        $maxcall = filter_input(INPUT_POST, 'maxcall',FILTER_SANITIZE_STRING);
        $precio_venta = filter_input(INPUT_POST, 'precio_venta',FILTER_SANITIZE_NUMBER_FLOAT);
        $referencia = filter_input(INPUT_POST, 'referencia',FILTER_SANITIZE_STRING);
        $dominio = filter_input(INPUT_POST, 'dominio',FILTER_SANITIZE_STRING);
        $saldo = filter_input(INPUT_POST, 'saldo',FILTER_SANITIZE_NUMBER_FLOAT);
        $descuento = filter_input(INPUT_POST, 'descuento',FILTER_SANITIZE_NUMBER_FLOAT);

        $cliente_productoDTO =  new cliente_productoDTO(0, $id_servidor, $id_cliente, $id_producto, $id_reseller, $ip_docker, $estado, $maxcall, $precio_venta, $referencia, $dominio, $saldo, $descuento);
        $cliente_productoDAO = new cliente_productoDAO($this->getConexion());
        $id_cliente_producto = $cliente_productoDAO->insert($cliente_productoDTO);

        //Actualiza el estado del server en "uso"

        if ($id_cliente_producto != 0){
            $servidorDAO = new servidorDAO($this->getConexion());
            $server = $servidorDAO->getById($id_servidor);
            
            $servidorDTO = new servidorDTO($server->id_servidor, $server->id_servidor_detalle, $server->ip, $server->tipo, 'uso', $server->periodicidad_pago, $server->nombre, $server->observacion);
            $result = $servidorDAO->update($servidorDTO);

            return $result;
        }
    }

    function updateByPost(){
        $id_cliente_producto = filter_input(INPUT_POST, 'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT);
        $id_servidor = filter_input(INPUT_POST, 'id_servidor',FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_input(INPUT_POST, 'id_cliente',FILTER_SANITIZE_NUMBER_INT);
        $id_producto = filter_input(INPUT_POST, 'id_producto',FILTER_SANITIZE_NUMBER_INT);
        $id_reseller = filter_input(INPUT_POST, 'id_reseller',FILTER_SANITIZE_NUMBER_INT);
        $ip_docker = filter_input(INPUT_POST, 'ip_docker',FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST, 'estado',FILTER_SANITIZE_STRING);
        $maxcall = filter_input(INPUT_POST, 'maxcall',FILTER_SANITIZE_STRING);
        $precio_venta = filter_input(INPUT_POST, 'precio_venta',FILTER_SANITIZE_NUMBER_FLOAT);
        $referencia = filter_input(INPUT_POST, 'referencia',FILTER_SANITIZE_STRING);
        $dominio = filter_input(INPUT_POST, 'dominio',FILTER_SANITIZE_STRING);
        $saldo = filter_input(INPUT_POST, 'saldo',FILTER_SANITIZE_NUMBER_FLOAT);
        $descuento = filter_input(INPUT_POST, 'descuento',FILTER_SANITIZE_NUMBER_FLOAT);

        $cliente_productoDAO = new cliente_productoDAO($this->getConexion());

        $estado_inicial = $cliente_productoDAO->getById($id_cliente_producto);

        $cliente_productoDTO =  new cliente_productoDTO($id_cliente_producto, $id_servidor, $id_cliente, $id_producto, $id_reseller, $ip_docker, $estado, $maxcall, $precio_venta, $referencia, $dominio, $saldo, $descuento);
        
        $id_cliente_producto = $cliente_productoDAO->update($cliente_productoDTO);

        //Actualiza el estado del server segun sea el caso

        switch ($estado){
            case "activo":
                if($estado != $estado_inicial->estado){
                    //lanza script de activacion
                }               
            break;

            case "suspendido";
                if($estado != $estado_inicial->estado){
                    //lanza script de suspension
                }
            break;

            case "cancelado";
                if($estado != $estado_inicial->estado){ 

                    $servidorDAO = new servidorDAO($this->getConexion());
                    $server = $servidorDAO->getById($id_servidor);
                    
                    $servidorDTO = new servidorDTO($server->id_servidor, $server->id_servidor_detalle, $server->ip, $server->tipo, 'libre', $server->periodicidad_pago, $server->nombre, $server->observacion);
                    $servidorDAO->update($servidorDTO);
        
                    //verifica si el cliente tiene servers activos
                    $server_activos_cliente = $cliente_productoDAO->getByIdCustom($id_cliente);

                    if($server_activos_cliente == 0){
                        $clienteDAO = new clienteDAO($this->getConexion());
                        $cliente = $clienteDAO->getById($id_cliente);
                        
                        $clienteDTO = new clienteDTO($cliente->id_cliente, $cliente->nombre, $cliente->cc_nit, $cliente->administrador, $cliente->direccion, $cliente->ciudad, $cliente->pais, 'inactivo');
                        $clienteDAO->insert($clienteDTO);          

                    }

                    //lanza script de cancelacion
                }
            break;
        }
    }

    function deleteByPost(){
        $id_cliente_producto = filter_input(INPUT_POST, 'id_cliente_producto',FILTER_SANITIZE_NUMBER_INT);
        $id_servidor = filter_input(INPUT_POST, 'id_servidor',FILTER_SANITIZE_NUMBER_INT);

        //actualiza estado servidor
        $cliente_productoDAO = new cliente_productoDAO($this->getConexion());
        $cliente_productoDAO->getById($id_cliente_producto);

        $cliente_productoDTO =  new cliente_productoDTO($cliente_productoDAO->id_cliente_producto, $cliente_productoDAO->id_servidor, $cliente_productoDAO->id_cliente, $cliente_productoDAO->id_producto, $cliente_productoDAO->id_reseller, $cliente_productoDAO->ip_docker, 'cancelado', $cliente_productoDAO->maxcall, $cliente_productoDAO->precio_venta, $cliente_productoDAO->referencia, $cliente_productoDAO->dominio, $cliente_productoDAO->saldo, $cliente_productoDAO->descuento);
        
        $id_cliente_producto = $cliente_productoDAO->update($cliente_productoDTO);

        //actualiza estado servidor
        $servidorDAO = new servidorDAO($this->getConexion());
        $server = $servidorDAO->getById($id_servidor);
        
        $servidorDTO = new servidorDTO($server->id_servidor, $server->id_servidor_detalle, $server->ip, $server->tipo, 'libre', $server->periodicidad_pago, $server->nombre, $server->observacion);
        $servidorDAO->update($servidorDTO);
    }
}

?>