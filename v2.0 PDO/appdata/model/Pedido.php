<?php

require_once("Console.php");


class Pedido {
    private $id;
    private $estado;
    private $photoPath;
    private $costeTotal;
    private $nombrePedido;
    private $fechaCreacion;


    public function __construct(){
        
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
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of photoPath
     */ 
    public function getPhotoPath()
    {
        return $this->photoPath;
    }

    /**
     * Set the value of photoPath
     *
     * @return  self
     */ 
    public function setPhotoPath($photoPath)
    {
        $this->photoPath = $photoPath;

        return $this;
    }

    /**
     * Get the value of costeTotal
     */ 
    public function getCosteTotal()
    {
        return $this->costeTotal;
    }

    /**
     * Set the value of costeTotal
     *
     * @return  self
     */ 
    public function setCosteTotal($costeTotal)
    {
        $this->costeTotal = $costeTotal;

        return $this;
    }

    /**
     * Get the value of nombrePedido
     */ 
    public function getNombrePedido()
    {
        return $this->nombrePedido;
    }

    /**
     * Set the value of nombrePedido
     *
     * @return  self
     */ 
    public function setNombrePedido($nombrePedido)
    {
        $this->nombrePedido = $nombrePedido;

        return $this;
    }

    /**
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
}