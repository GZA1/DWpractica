<?php

namespace Entities;
/**
 * @Entity
 */

 class Pedido
 {
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     */
    private $id;
    /**
     * @Column(length=45, nullable=false)
     */
    private $estado;
    /**
     * @Column(type="datetime", nullable=false)
     */
    private $fechaCreacion;
    
 }
?>