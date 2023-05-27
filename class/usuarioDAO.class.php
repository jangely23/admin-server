<?php 
/*
 Entidad: usuario
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/
class usuarioDAO extends conexion{
    function __construct($conexion) {
        parent::__construct($conexion);
    }

    function getById(int $id_usuario){
        $query = sprintf("SELECT * FROM usuario WHERE id_usuario = %d", $id_usuario);
        $result = $this->getConexion()->query($query);

        if($result){
            if( $result->num_rows != 0){
                return $result->fetch_object();
            }else{
                return 0;
            }
        }else{
            throw new Exception("Error al intentar getById() en usuarioDAO");
        }
    }

    function getByEmailAndClave(string $email, string $clave) {
        $query = sprintf("select * from usuario where (email='%s' or usuario='%s') and clave='%s' ", $email, $email,$clave);
        
        $result = $this->getConexion()->query($query);

        if ($result) {
            if ($result->num_rows) {
                return $result->fetch_object();
            } else {
                return false;
            }
        } else {
            throw new Exception("Error al intentar getByEmailAndClave() en usuarioDAO");
        }
    }

    function getAll(){
        $query = "SELECT * FROM usuario";
        $result = $this->getConexion()->query($query);

        if($result){
            return $result;
        }else{
            throw new Exception("Error al intentar getAll() en usuarioDAO");
        }
    }

    function insert(usuarioDTO $usuarioDTO){
        $query = sprintf("INSERT INTO usuario (nombre, email, usuario, clave, estado) VALUES ('%s', '%s', '%s', '%s', '%s')", $usuarioDTO->getNombre(), $usuarioDTO->getEmail(), $usuarioDTO->getUsuario(), $usuarioDTO->getClave(), $usuarioDTO->getEstado());

        $result = $this->getConexion()->query($query);

        if($result){
            return $this->getConexion()->insert_id;
        }else{
            throw new Exception("Error al intentar insert() en usuarioDAO");
        }

    }

    function update(usuarioDTO $usuarioDTO){
        $query = sprintf("UPDATE usuario SET nombre = '%s', email = '%s', usuario = '%s', clave = '%s', estado = '%s' WHERE id_usuario = '%d'", $usuarioDTO->getNombre(), $usuarioDTO->getEmail(), $usuarioDTO->getUsuario(), $usuarioDTO->getClave(), $usuarioDTO->getEstado(), $usuarioDTO->getId_usuario());

        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar insert() en usuarioDAO");
        }

    }

    function delete(int $id_usuario){
        $query= sprintf("DELETE FROM usuario WHERE id_usuario = %d", $id_usuario);
        $result = $this->getConexion()->query($query);

        if($result){
            return true;
        }else{
            throw new Exception("Error al intentar delete() en usuarioDAO");
        }
    }

}

?>