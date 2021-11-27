<?php
class servidorCOORDINATOR extends conexion{
    function __construct($conexion){
        parent::__construct($conexion);
    }

    function createByPost(){
        $nombre = filter_input(INPUT_POST, 'nombre',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario',FILTER_SANITIZE_STRING);
        $clave = md5(filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING));
        $estado = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_STRING);
        
        $usuarioDAO = new usuarioDAO($this->getConexion());
        $usuarioDTO = new usuarioDTO(0, $nombre, $email, $usuario, $clave, $estado);
        
        return $usuarioDAO->insert($usuarioDTO);  
    }

    function updateByPost(){
        $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT);
        $nombre = filter_input(INPUT_POST, 'nombre',FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email',FILTER_SANITIZE_STRING);
        $usuario = filter_input(INPUT_POST, 'usuario',FILTER_SANITIZE_STRING);
        $clave = md5(filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING));
        $estado = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_STRING);
        
        $usuarioDAO = new usuarioDAO($this->getConexion());
        $usuarioDTO = new usuarioDTO($id_usuario, $nombre, $email, $usuario, $clave, $estado);
        
        return $usuarioDAO->update($usuarioDTO);  
    }

    function deleteByPost(){
        $id_usuario = filter_input(INPUT_POST,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
        $usuarioDAO = new usuarioDAO($this->getConexion());
        
        return $usuarioDAO->delete($id_usuario);
    }

    function login() {
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $clave = md5(filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING));
        $usuarioDTO = new usuarioDTO();
        
        if ($usuarioDTO->loadByEmailAndClave($email, $clave, $this->getConexion())) {
            session_name("admin");
            session_start();
            $_SESSION['id_usuario'] = $usuarioDTO->getId_usuario();
            $_SESSION['nombre'] = $usuarioDTO->getNombre();
            $_SESSION['en_session'] = true;
            return true;
        } else {
            return false;
        }
    }

}
?>