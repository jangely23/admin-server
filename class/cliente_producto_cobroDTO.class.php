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
    private string $fecha_corte;
    private string $fecha_pago;
    private string $fecha_suspension;
    private string $estado;
    private string $observacion;
    private float $valor;

    function __construct(int $id_cliente_producto_cobro=0, $id_cliente_producto=0, string $cuenta_cobro='', int $numero_cuenta=0, string $fecha_corte='', $fecha_pago='', $fecha_suspension='', $estado='', $observacion='', float $valor=0) {
        $this->id_cliente_producto_cobro = $id_cliente_producto_cobro;
        $this->id_cliente_producto = $id_cliente_producto;
        $this->cuenta_cobro = $cuenta_cobro;
        $this->numero_cuenta = $numero_cuenta;
        $this->fecha_corte = $fecha_corte;
        $this->fecha_pago = $fecha_pago;
        $this->fecha_suspension = $fecha_suspension;
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

    public function getFecha_corte(): string { return $this->fecha_corte; }
    public function setFecha_corte(string $fecha_corte): void { $this->fecha_corte = $fecha_corte; }

    public function getFecha_pago(): string { return $this->fecha_pago; }
    public function setFecha_pago(string $fecha_pago): void { $this->fecha_pago = $fecha_pago; }

    public function getFecha_suspension(): string { return $this->fecha_suspension; }
    public function setFecha_suspension(string $fecha_suspension): void { $this->fecha_suspension = $fecha_suspension; }
  
    function map($obj){
        $this->setId_cliente_producto_cobro($obj->id_cliente_producto_cobro);
        $this->setId_cliente_producto($obj->id_cliente_producto);
        $this->setCuenta_cobro($obj->cuenta_cobro);
        $this->setNumero_cuenta($obj->numero_cuenta);
        $this->setFecha_corte($obj->fecha_corte);
        $this->setFecha_pago($obj->fecha_pago);
        $this->setFecha_suspension($obj->fecha_suspension);
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
