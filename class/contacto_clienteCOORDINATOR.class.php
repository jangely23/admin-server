<?php 

class contacto_clienteCOORDINATOR extends conexion{
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    function createByPost(){
        $id_cliente = filter_input(INPUT_POST,'id_cliente',FILTER_SANITIZE_NUMBER_INT);
        $telefono = filter_input(INPUT_POST,'telefono',FILTER_SANITIZE_STRING);
        $celular = filter_input(INPUT_POST,'celular',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $otro = filter_input(INPUT_POST,'otro',FILTER_SANITIZE_STRING);

        $contacto_clienteDTO = new contacto_clienteDTO(0,$id_cliente,$telefono,$celular,$email,$otro);
        $contacto_clienteDAO = new contacto_clienteDAO($this->getConexion());
        $result = $contacto_clienteDAO->insert($contacto_clienteDTO);

        return $result;
    }

    function updateByPost(){
        $id_contacto_cliente = filter_input(INPUT_POST,'id_contacto_cliente',FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_input(INPUT_POST,'id_cliente',FILTER_SANITIZE_NUMBER_INT);
        $telefono = filter_input(INPUT_POST,'telefono',FILTER_SANITIZE_STRING);
        $celular = filter_input(INPUT_POST,'celular',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $otro = filter_input(INPUT_POST,'otro',FILTER_SANITIZE_STRING);

        $contacto_clienteDTO = new contacto_clienteDTO($id_contacto_cliente,$id_cliente,$telefono,$celular,$email,$otro);
        $contacto_clienteDAO = new contacto_clienteDAO($this->getConexion());
        $result = $contacto_clienteDAO->update($contacto_clienteDTO);

        return $result;
    }

    function deleteByPost(){
        $id_contacto_cliente = filter_input(INPUT_POST,'id_contacto_cliente',FILTER_SANITIZE_NUMBER_INT);
        $contacto_clienteDAO = new contacto_clienteDAO($this->getConexion());
        $result = $contacto_clienteDAO->delete($id_contacto_cliente);

        return $result;

    }
}

?>