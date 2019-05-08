<?php

namespace Entities;

/** @Entity */

class Empleado
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
    private $photoPath;
    /** 
     * @Column(type="boolean", nullable=false)
     */
    private $activo;
    /** 
     * @Column(length=45, nullable=false)
     */
    private $cargo;
    /**
     *  @Column(type="boolean", nullable=false)
     */
    private $isAdministrador;
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