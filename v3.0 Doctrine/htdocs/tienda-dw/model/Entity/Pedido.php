<?php

namespace Entity;

/**
 * @Entity(repositoryClass="Repository\PedidoRepository")
 */

 class Pedido
 {
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", nullable=false)
     */
    private $id;
    /**
     * @Column(name="estado",length=45, nullable=false)
     */
    private $estado;
    /**
     * @Column(name="fechaCreacion",type="datetime", nullable=false)
     */
    private $fechaCreacion;

    /**
    * Un pedido es de una cesta
    * @OneToOne(targetEntity="Cesta", inversedBy="pedido")
    * @JoinColumn(name="Cesta_id", referencedColumnName="id")
    */
    private $cesta;

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
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set the value of fechaCreacion
     *
     * @return  self
     */ 
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get un pedido es de una cesta
     */ 
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set un pedido es de una cesta
     *
     * @return  self
     */ 
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }
 }
?>