<?php
/** @Entity */

class Empleado
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
    private $photoPath;
    /** 
     * @Column(type="boolean")
     */
    private $activo;
    /** 
     * @Column(length=45)
     */
    private $cargo;
    /**
     *  @Column(type="boolean")
     */
    private $isAdministrador;
    /** 
     * @Column(type="datetime")
     */
    private $fechaCreacion;



    
    /** 
     * @Column(type="datetime")
     */
    private $fechaModificacion;
    



}
?>