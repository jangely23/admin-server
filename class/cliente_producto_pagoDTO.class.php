<?php
/* 
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_pagoDTO {
    private int $id_cliente_producto_pago;
    private int $id_cliente_producto;
    private string $fecha_pago;
    private string $medio_pago;
    private float $valor;
    private string $soporte;
    private string $validacion;


    function __construct(int $id_cliente_producto_pago=0, $id_cliente_producto=0, string $fecha_pago='', $medio_pago='', float $valor=0, string $soporte='', $validacion='' ) {
        $this->id_cliente_producto_cobro = $id_cliente_producto_pago;
        $this->id_cliente_producto = $id_cliente_producto;
        $this->fecha_pago = $fecha_pago;
        $this->medio_pago = $medio_pago;
        $this->valor = $valor;
        $this->soporte = $soporte;
        $this->validacion = $validacion;
    }
    

    public function getId_cliente_producto_pago(): int { return $this->id_cliente_producto_pago; }
    public function setId_cliente_producto_pago(int $id_cliente_producto_pago): void { $this->id_cliente_producto_pago = $id_cliente_producto_pago; }

    public function getId_cliente_producto(): int { return $this->id_cliente_producto; }
    public function setId_cliente_producto(int $id_cliente_producto): void { $this->id_cliente_producto = $id_cliente_producto;  }

    public function getMedio_pago(): string { return $this->medio_pago; }
    public function setMedio_pago(string $medio_pago): void { $this->medio_pago = $medio_pago; }

    public function getSoporte(): string { return $this->soporte; }
    public function setSoporte(string $soporte): void { $this->soporte = $soporte; }

    public function getValidacion(): string { return $this->validacion; }
    public function setValidacion(string $validacion): void { $this->validacion = $validacion; }

    public function getValor(): float { return $this->valor; }
    public function setValor(float $valor): void { $this->valor = $valor; }

    public function getFecha_pago(): string { return $this->fecha_pago; }
    public function setFecha_pago(string $fecha_pago): void { $this->fecha_pago = $fecha_pago; }

    function map($obj){
        $this->setId_cliente_producto_pago($obj->id_cliente_producto_pago);
        $this->setId_cliente_producto($obj->id_cliente_producto);
        $this->setFecha_pago($obj->fecha_pago);
        $this->setMedio_pago($obj->medio_pago);
        $this->setValor($obj->valor);
        $this->setSoporte($obj->soporte);
        $this->setValidacion($obj->validacion);
    }

    function loadById(int $id_cliente_producto_pago, mysqli $conexion){
        $cliente_producto_pagoDAO = new cliente_producto_pagoDAO($conexion);
        $obj = $cliente_producto_pagoDAO->getById($id_cliente_producto_pago);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }


}
?>