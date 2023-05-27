<?php
/*
 Author: Jessica Leonel
 Email: Jessica.leonel.p@gmail.com   
*/
class cliente_productoDTO{
    private int $id_cliente_producto;
    private int $id_servidor;
    private int $id_cliente;
    private int $id_producto;
    private int $id_reseller;
    private string $ip_docker;
    private string $estado;
    private int $maxcall;
    private float $precio_venta;
    private string $referencia;
    private string $dominio;
    private float $saldo;
    private float $descuento;
    private int $cobro;

    function __construct(int $id_cliente_producto=0, $id_servidor=0, $id_cliente=0, $id_producto=0, $id_reseller=0,string $ip_docker='', $estado='',int $maxcall=0, float $precio_venta=0, string $referencia='', $dominio='', float $saldo=0, $descuento=0, $cobro=1){
        $this->id_cliente_producto = $id_cliente_producto;
        $this->id_servidor = $id_servidor;
        $this->id_cliente = $id_cliente;
        $this->id_producto = $id_producto;
        $this->id_reseller = $id_reseller;
        $this->ip_docker = $ip_docker;
        $this->estado = $estado;
        $this->maxcall = $maxcall;
        $this->precio_venta = $precio_venta;
        $this->referencia = $referencia;
        $this->dominio = $dominio;
        $this->saldo = $saldo;
        $this->descuento = $descuento;
        $this->cobro = $cobro;
    }

    public function getId_cliente_producto(): int { return $this->id_cliente_producto; }
    public function setId_cliente_producto(int $id_cliente_producto): void{ $this->id_cliente_producto = $id_cliente_producto; }

    public function getId_servidor(): int { return $this->id_servidor; }
    public function setId_servidor(int $id_servidor): void { $this->id_servidor = $id_servidor;  }

    public function getId_cliente(): int { return $this->id_cliente; }
    public function setId_cliente(int $id_cliente): void { $this->id_cliente = $id_cliente; }

    public function getId_producto(): int { return $this->id_producto; }
    public function setId_producto(int $id_producto): void { $this->id_producto = $id_producto;  }

    public function getId_reseller(): int { return $this->id_reseller; }
    public function setId_reseller(int $id_reseller): void { $this->id_reseller = $id_reseller; }

    public function getIp_docker(): string { return $this->ip_docker; }
    public function setIp_docker(string $ip_docker): void { $this->ip_docker = $ip_docker; }

    public function getEstado(): string { return $this->estado; }
    public function setEstado(string $estado): void { $this->estado = $estado; }

    public function getMaxcall(): string { return $this->maxcall; }
    public function setMaxcall(int $maxcall): void { $this->maxcall = $maxcall; }

    public function getPrecio_venta(): float { return $this->precio_venta; }
    public function setPrecio_venta(float $precio_venta): void { $this->precio_venta = $precio_venta; }

    public function getReferencia(): string { return $this->referencia; }
    public function setReferencia(string $referencia): void { $this->referencia = $referencia; }

    public function getDominio(): string { return $this->dominio; }
    public function setDominio(string $dominio): void { $this->dominio = $dominio; }

    public function getSaldo(): float { return $this->saldo; }
    public function setSaldo(float $saldo): void { $this->saldo = $saldo; }

    public function getDescuento(): float { return $this->descuento; }
    public function setDescuento(float $descuento): void { $this->descuento = $descuento; }

    public function getCobro(): float { return $this->cobro; }
    public function setCobro(float $cobro): void { $this->cobro = $cobro; }

    function map($obj){
        $this->setId_cliente_producto($obj->id_cliente_producto);
        $this->setId_servidor($obj->id_servidor);
        $this->setId_cliente($obj->id_cliente);
        $this->setId_producto($obj->id_producto);
        $this->setId_reseller($obj->id_reseller);
        $this->setIp_docker($obj->ip_docker);
        $this->setEstado($obj->estado);
        $this->setMaxcall($obj->maxcall);
        $this->setPrecio_venta($obj->precio_venta);
        $this->setReferencia($obj->referencia);
        $this->setDominio($obj->dominio);
        $this->setSaldo($obj->saldo);
        $this->setDescuento($obj->descuento);
        $this->setCobro($obj->cobro);
    }

    function loadById(int $id_cliente_producto, mysqli $conexion){
        $cliente_productoDAO = new cliente_productoDAO($conexion);
        $obj = $cliente_productoDAO->getById($id_cliente_producto);

        if($obj){
            $this->map($obj);
            return true;
        }else{
            return false;
        }
    }
}

?>