<?php

namespace Entities;
/** @Entity */
class Tienda 
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
    private $direccion;
    
    /**
     * @Column(length=45, nullable=false)
     */
    private $email;
    

    


}
?>