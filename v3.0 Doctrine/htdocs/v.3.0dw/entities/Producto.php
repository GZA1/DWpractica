<?php

/** @Entity */
class Producto 
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private $id;
    /**
     * @Column(length=45)
     */
    private $nombre;
    /**
     * @Column(length=45)
     */
    private $marca;
    /**
     * @Column(length=45)
     */
    private $modelo;
    /**
     * @Column(type="float")
     */
    private $precio;



    
    /**
     * @Column(length=45, name="Categoria_id")
     */
    private $Categoria;
}
?>