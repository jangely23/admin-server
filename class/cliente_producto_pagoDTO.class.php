<?php
/* 
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/

class cliente_producto_pagoDTO {
    private int $id_cliente_producto_pago;
    private int $id_cliente_producto;
    private string $medio_pago;
    private float $valor;
    private string $soporte;
    private string $valicacion;


    function __construct(int $id_cliente_producto_cobro=0, $id_cliente_producto=0, string $medio_pago='', float $valor=0, string $soporte='', $valicacion='' ) {
        $this->id_cliente_producto_cobro = $id_cliente_producto_cobro;
        $this->id_cliente_producto = $id_cliente_producto;
        $this->medio_pago = $medio_pago;
        $this->valor = $valor;
        $this->soporte = $soporte;
        $this->valicacion = $valicacion;
    }
    

    public function getId_cliente_producto_cobro(): int { return $this->id_cliente_producto_cobro; }
    public function setId_cliente_producto_cobro(int $id_cliente_producto_cobro): void { $this->id_cliente_producto_cobro = $id_cliente_producto_cobro; }

    public function getId_cliente_producto(): int { return $this->id_cliente_producto; }
    public function setId_cliente_producto(int $id_cliente_producto): void { $this->id_cliente_producto = $id_cliente_producto;  }

    public function getMedio_pago(): string { return $this->medio_pago; }
    public function setMedio_pago(string $medio_pago): void { $this->medio_pago = $medio_pago; }

    public function getSoporte(): string { return $this->soporte; }
    public function setSoporte(int $soporte): void { $this->soporte = $soporte; }

      public function getValicacion(): string { return $this->valicacion; }
    public function setValicacion(string $valicacion): void { $this->observacion = $valicacion; }

    public function getValor(): float { return $this->valor; }
    public function setValor(float $valor): void { $this->valor = $valor; }

    function map($obj){
        $this->setId_cliente_producto_cobro($obj->id_cliente_producto_cobro);
        $this->setId_cliente_producto($obj->id_cliente_producto);
        $this->setMedio_pago($obj->medio_pago);
        $this->setValor($obj->valor);
        $this->setSoporte($obj->soporte);
        $this->setValicacion($obj->valicacion);
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