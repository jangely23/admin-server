<?php
/* 
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_cobroDTO {
    private int $id_cliente_producto_cobro;
    private int $id_cliente_producto;
    private string $cuenta_cobro;
    private int $numero_cuenta;
    private string $estado;
    private string $observacion;
    private float $valor;

    function __construct(int $id_cliente_producto_cobro=0, $id_cliente_producto=0, string $cuenta_cobro='', int $numero_cuenta=0, string $estado='', $observacion='', float $valor=0) {
        $this->id_cliente_producto_cobro = $id_cliente_producto_cobro;
        $this->id_cliente_producto = $id_cliente_producto;
        $this->cuenta_cobro = $cuenta_cobro;
        $this->numero_cuenta = $numero_cuenta;
        $this->estado = $estado;
        $this->observacion = $observacion;
        $this->valor = $valor;
    }
    

    public function getId_cliente_producto_cobro(): int { return $this->id_cliente_producto_cobro; }
    public function setId_cliente_producto_cobro(int $id_cliente_producto_cobro): void { $this->id_cliente_producto_cobro = $id_cliente_producto_cobro; }

    public function getId_cliente_producto(): int { return $this->id_cliente_producto; }
    public function setId_cliente_producto(int $id_cliente_producto): void { $this->id_cliente_producto = $id_cliente_producto;  }

    public function getCuenta_cobro(): string { return $this->cuenta_cobro; }
    public function setCuenta_cobro(string $cuenta_cobro): void { $this->cuenta_cobro = $cuenta_cobro; }

    public function getNumero_cuenta(): int { return $this->numero_cuenta; }
    public function setNumero_cuenta(int $numero_cuenta): void { $this->numero_cuenta = $numero_cuenta; }

    public function getEstado(): string { return $this->estado; }
    public function setEstado(string $estado): void { $this->estado = $estado; }

    public function getObservacion(): string { return $this->observacion; }
    public function setObservacion(string $observacion): void { $this->observacion = $observacion; }

    public function getValor(): float { return $this->valor; }
    public function setValor(float $valor): void { $this->valor = $valor; }

    function map($obj){
        $this->setId_cliente_producto_cobro($obj->id_cliente_proucto_cobro);
        $this->setId_cliente_producto($obj->id_cliente_proucto);
        $this->setCuenta_cobro($obj->cuenta_cobro);
        $this->setNumero_cuenta($obj->numero_cuenta);
        $this->setEstado($obj->estado);
        $this->setObservacion($obj->observacion);
        $this->setValor($obj->valor);
    }

    function loadById(int $id_cliente_producto_cobro, mysqli $conexion){
        $cliente_producto_cobroDAO = new cliente_producto_cobroDAO($conexion);
        $obj = $cliente_producto_cobroDAO->getById($id_cliente_producto_cobro);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}
?>