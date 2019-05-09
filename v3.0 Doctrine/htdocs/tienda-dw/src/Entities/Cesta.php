<?php

namespace Entities;

/**
 * @Entity
 */

class Cesta
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id",type="integer", nullable=false)
     */
    private $id;

    /**
     * @Column(name="costeTotal",type="float", nullable=false)
     */
    private $costeTotal;

    /**
    * Un cliente tiene una cesta
    * @OneToOne(targetEntity="Cliente", inversedBy="cesta")
    * @JoinColumn(name="Cliente_id", referencedColumnName="id")
    */
    private $cliente;

    /**
    * Un cesta tiene muchas unidades
    * @OneToMany(targetEntity="Unidad", mappedBy="cesta")
    */
    private $unidades;

    /**
    * Una cesta es de un pedido
    * @OneToOne(targetEntity="Pedido", mappedBy="cesta")
    */
    private $pedido;

    public function __construct()
    {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();  
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
     * Get un cliente tiene una cesta
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set un cliente tiene una cesta
     *
     * @return  self
     */ 
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get un cesta tiene muchas unidades
     */ 
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set un cesta tiene muchas unidades
     *
     * @return  self
     */ 
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * Get una cesta es de un pedido
     */ 
    public function getPedido()
    {
        return $this->pedido;
    }

    /**
     * Set una cesta es de un pedido
     *
     * @return  self
     */ 
    public function setPedido($pedido)
    {
        $this->pedido = $pedido;

        return $this;
    }
}
?>