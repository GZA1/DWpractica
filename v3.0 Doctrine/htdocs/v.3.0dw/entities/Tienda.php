<?php

/** @Entity */
class Tienda 
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
    private $direccion;
    
    /**
     * @Column(length=45)
     */
    private $email;
    

    
    /**
     * @Column(length=45, name="Ubicacion_id_Ubicacion")
     */
    private $Ubicacion;


}
?>