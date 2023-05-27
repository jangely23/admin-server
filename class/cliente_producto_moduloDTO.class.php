<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_moduloDTO{
    private int $id_cliente_producto_modulo;
    private int $id_cliente_producto;
    private int $id_modulo;

    function __construct(int $id_cliente_producto_modulo=0, $id_cliente_producto=0, $id_modulo=0){
        $this->id_cliente_producto_modulo = $id_cliente_producto_modulo;
        $this->id_cliente_producto = $id_cliente_producto;
        $this->id_modulo = $id_modulo;
    }

    public function getId_cliente_producto_modulo(): int { return $this->id_cliente_producto_modulo; }
    public function setId_cliente_producto_modulo(int $id_cliente_producto_modulo): void { $this->id_cliente_producto_modulo = $id_cliente_producto_modulo; }

    public function getId_cliente_producto(): int { return $this->id_cliente_producto; }
    public function setId_cliente_producto(int $id_cliente_producto): void { $this->id_cliente_producto = $id_cliente_producto; }

    public function getId_modulo(): int { return $this->id_modulo; }
    public function setId_modulo(int $id_modulo): void { $this->id_modulo = $id_modulo; }

    function map($obj){
        $this->setId_cliente_producto_modulo($obj->id_cliente_producto_modulo);
        $this->setId_cliente_producto($obj->id_cliente_producto);
        $this->setId_modulo($obj->id_modulo);
    }

    function loadById(int $id_cliente_producto_modulo, mysqli $conexion){
        $cliente_producto_moduloDAO = new cliente_producto_moduloDAO($conexion);
        $obj = $cliente_producto_moduloDAO->getById($id_cliente_producto_modulo);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}

?>