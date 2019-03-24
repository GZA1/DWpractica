<?php

require_once("Console.php");

class Saldo{
    public static $saldoPath = '/xampp/appdata/data/saldos.json';
    private $id;
    private $cantidad;

    public function __construct($id){
        $this->id = $id;
        $this->cantidad = $this->getCantidadById();
    }

    public function getAllSaldos(){
        return (array)json_decode(file_get_contents((Saldo::$saldoPath), true));
    }

    public function getCantidadById(){
        $saldos = $this->getAllSaldos();
        if( ! is_null($saldos) ){
            foreach($saldos as $k => $s){
                if($this->id == $k){
                    $saldoEuros = json_decode($s, true)['saldoEuros'];
                    if( ! is_null($saldoEuros) )
                        return $saldoEuros;
                }
            }
        }
        $this->cantidad = 0;
        $this->add();
        return null;
    }

    public function add(){
        $saldos = $this->getAllSaldos();
        $saldos[$this->id] = $this->toJson();
        file_put_contents( Saldo::$saldoPath, json_encode($saldos, JSON_PRETTY_PRINT) );
        return true;
    }

    public function toJson(){
        return json_encode([
            "saldoEuros" => $this->cantidad
         ]);
    }

    public function aumentarCantidad($nc){
        $this->cantidad += $nc;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return number_format(floatval($this->cantidad),2);
    }

    /**
     * Set the value of cantidad
     *
     * @return  self
     */ 
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }
}
?>