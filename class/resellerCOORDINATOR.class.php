<?php 

class resellerCOORDINATOR extends conexion{
    function __construct(mysqli $conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $celular = filter_input(INPUT_POST,'celular',FILTER_SANITIZE_STRING);
    
        $resellerDTO = new resellerDTO(0, $nombre, $email, $celular);
        $resellerDAO = new resellerDAO($this->getConexion());
        $result = $resellerDAO->insert($resellerDTO);
        
        return $result;
    }

    function updateByPost(){
        $id_reseller = filter_input(INPUT_POST,'id_reseller',FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST,'nombre',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_STRING);
        $celular = filter_input(INPUT_POST,'celular',FILTER_SANITIZE_STRING);
    
        $resellerDTO = new resellerDTO($id_reseller, $nombre, $email, $celular);
        $resellerDAO = new resellerDAO($this->getConexion());
        $result = $resellerDAO->update($resellerDTO);
        
        return $result;
    }

    function deleteByPost(){
        $id_reseller = filter_input(INPUT_POST,'id_reseller',FILTER_SANITIZE_NUMBER_INT);
        
        $resellerDAO = new resellerDAO($this->getConexion());
        $result = $resellerDAO->delete($id_reseller);

        return $result;
    }

}

?>
