<?php 

class clienteCOORDINADOR extends conexion{

    function __construct(mysqli $conexion){
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

            $insert_contacto = $contacto_clienteDAO->insert($contacto_clienteDTO);
        }

        return $insertId;
    }

}

?>