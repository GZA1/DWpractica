<?php

namespace Entities;

/** @Entity */
class Cliente 
{

    /**
     * @Id
     * @Column(length=45, nullable=false)
     */
    private $id;
    
    /**
     * @Column(length=45, nullable=false)
     */
    private $username;
    /**
     * 
     * @Column(length=45, nullable=false)
     */
    private $passwd;
    /**
     * @Column(length=45, nullable=false)
     */
    private $nombre;
    /**
     * @Column(length=45, nullable=false)
     */
    private $apellidos;
    /**
     * @Column(length=45, nullable=false)
     */
    private $email;
    /**
     * @Column(length=45, nullable=true)
     */
    private $domicilio;
    /**
     * @Column(type="float", nullable=false)
     */
    private $saldo;
    /**
     * @Column(type="datetime", nullable=false)
     */
    private $fechaCreacion;
    /**
     * @Column(type="datetime", nullable=false)
     */
    private $fechaModificacion;


    
 
}
?>