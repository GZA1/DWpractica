<?php

namespace Entities;

/** @Entity */
class Producto 
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     */
    private $id;
    /**
     * @Column(length=45, nullable=false)
     */
    private $nombre;
    /**
     * @Column(length=45, nullable=false)
     */
    private $marca;
    /**
     * @Column(length=45, nullable=false)
     */
    private $modelo;
    /**
     * @Column(type="float", nullable=false)
     */
    private $precio;
}
?>