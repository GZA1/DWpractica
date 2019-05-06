<?php

/** @Entity */
class Cliente 
{

    /**
     * @Id
     * @Column(length=45)
     */
    private $id;
    
    /**
     * @Column(length=45)
     */
    private $username;
    /**
     * 
     * @Column(length=45)
     */
    private $passwd;
    /**
     * @Column(length=45)
     */
    private $nombre;
    /**
     * @Column(length=45)
     */
    private $apellidos;
    /**
     * @Column(length=45)
     */
    private $email;
    /**
     * @Column(length=45)
     */
    private $domicilio;
    /**
     * @Column(type="float")
     */
    private $saldo;
    /**
     * @Column(type="datetime")
     */
    private $fechaCreacion;
    /**
     * @Column(type="datetime")
     */
    private $fechaModificacion;


    
    /**
     * @Column(type="integer", name="Ubicacion_id_Ubicacion")
     */
    private $Ubicacion;

}
?>