<?php

namespace Entities;

/**
 * @Entity
 */
class Unidad
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     */
    private $id;
    /**
     * @Column(type="boolean", nullable=false)
     */
    private $vendido;


    /**
    * Una unidad pertenece a una cesta
    * @ManyToOne(targetEntity="Cesta", inversedBy="unidades")
    * @JoinColumn(name="cesta_id", referencedColumnName="id")
    */
    private $cesta;

    /**
    * Una unidad pertenece a una tienda
    * @ManyToOne(targetEntity="Tienda", inversedBy="unidades")
    * @JoinColumn(name="tienda_id", referencedColumnName="id")
    */
    private $tienda;

    /**
    * Una unidad es de un producto
    * @ManyToOne(targetEntity="Producto", inversedBy="unidades")
    * @JoinColumn(name="producto_id", referencedColumnName="id")
    */
    private $producto;




    public function __construct()
    {
        
    }



    
    /** GETTERS & SETTERS */


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
     * Get the value of vendido
     */ 
    public function isVendido()
    {
        return $this->vendido;
    }

    /**
     * Set the value of vendido
     *
     * @return  self
     */ 
    public function setVendido($vendido)
    {
        $this->vendido = $vendido;

        return $this;
    }

    /**
     * Get una unidad pertenece a una cesta
     */ 
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set una unidad pertenece a una cesta
     *
     * @return  self
     */ 
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }

    /**
     * Get una unidad pertenece a una tienda
     */ 
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Set una unidad pertenece a una tienda
     *
     * @return  self
     */ 
    public function setTienda($tienda)
    {
        $this->tienda = $tienda;

        return $this;
    }

    /**
     * Get una unidad es de un producto
     */ 
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set una unidad es de un producto
     *
     * @return  self
     */ 
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }
}
?>