<?php 

class clienteCOORDINATOR extends conexion{

    function __construct($conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $cc_nit = filter_input(INPUT_POST,'cc_nit',FILTER_SANITIZE_STRING);
        $administrador = filter_input(INPUT_POST,'administrador',FILTER_SANITIZE_STRING);
        $direccion = filter_input(INPUT_POST,'direccion',FILTER_SANITIZE_STRING);
        $ciudad = filter_input(INPUT_POST,'ciudad',FILTER_SANITIZE_STRING);
        $pais = filter_input(INPUT_POST,'pais',FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST,'estado',FILTER_SANITIZE_STRING);
    
        $telefono = filter_input(INPUT_POST,"telefono",FILTER_SANITIZE_NUMBER_INT);
        $celular = filter_input(INPUT_POST,"celular",FILTER_SANITIZE_NUMBER_INT);
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
        $otro = filter_input(INPUT_POST,"otro",FILTER_SANITIZE_STRING);


        $clienteDAO = new clienteDAO($this->getConexion());
        $clienteDTO = new clienteDTO(0,$nombre, $cc_nit,$administrador, $direccion, $ciudad, $pais, $estado);

        $insertId = $clienteDAO->insert($clienteDTO);

        if($insertId != 0){
            $contacto_clienteDAO = new contacto_clienteDAO($this->getConexion());
            $contacto_clienteDTO = new contacto_clienteDTO(0,$insertId, $telefono, $celular, $email,$otro);

            $contacto_clienteDAO->insert($contacto_clienteDTO);
        }

        return $insertId;
    }

    function updateByPost(){
        $id_cliente = filter_input(INPUT_POST,'id_cliente', FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $cc_nit = filter_input(INPUT_POST,'cc_nit',FILTER_SANITIZE_STRING);
        $administrador = filter_input(INPUT_POST,'administrador',FILTER_SANITIZE_STRING);
        $direccion = filter_input(INPUT_POST,'direccion',FILTER_SANITIZE_STRING);
        $ciudad = filter_input(INPUT_POST,'ciudad',FILTER_SANITIZE_STRING);
        $pais = filter_input(INPUT_POST,'pais',FILTER_SANITIZE_STRING);
        $estado = filter_input(INPUT_POST,'estado',FILTER_SANITIZE_STRING);
    
        $telefono = filter_input(INPUT_POST,"telefono",FILTER_SANITIZE_NUMBER_INT)??0;
        $celular = filter_input(INPUT_POST,"celular",FILTER_SANITIZE_NUMBER_INT)??0;
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL)??'';
        $otro = filter_input(INPUT_POST,"otro",FILTER_SANITIZE_STRING)??'';


        $clienteDAO = new clienteDAO($this->getConexion());
        $clienteDTO = new clienteDTO($id_cliente,$nombre, $cc_nit,$administrador, $direccion, $ciudad, $pais, $estado);

        $result =$clienteDAO->update($clienteDTO);

        if($email != ''){
            $contacto_clienteDAO = new contacto_clienteDAO($this->getConexion());
            $contacto_clienteDTO = new contacto_clienteDTO(0,$id_cliente, $telefono, $celular, $email,$otro);

            $contacto_clienteDAO->insert($contacto_clienteDTO);
        }

        return $result;
    }

    function deleteByPost(){
        $id_cliente = filter_input(INPUT_POST,'id_cliente',FILTER_SANITIZE_NUMBER_INT);
        $clienteDAO = new clienteDAO($this->getConexion());

        $contacto_clienteDAO = new contacto_clienteDAO($this->getConexion());
        $result_contacto = $contacto_clienteDAO->deleteByCustomer($id_cliente);

        if ($result_contacto){
            return $clienteDAO->delete($id_cliente);
        }


    }
}

?>