<?php

namespace Entities;

/** @Entity */

class Empleado
{
    /** 
     * @Id @GeneratedValue
     * @Column(name="id",length=45, nullable=false) 
    */
    private $id;
    /** 
     * @Column(name="username",length=45, nullable=false)
    */
    private $username;
    /** 
     * @Column(name="passwd",length=45, nullable=false)
    */
    private $passwd;
    /** 
     * @Column(name="nombre",length=45, nullable=false) 
    */
    private $nombre;
    /** 
     * @Column(name="apellidos",length=45, nullable=false) 
    */
    private $apellidos;
    /** 
     * @Column(name="email",length=45, nullable=false)
    */
    private $email;
    /** 
     * @Column(name="photoPath",length=45, nullable=true)
     */
    private $photoPath;
    /** 
     * @Column(name="activo",type="boolean", nullable=false)
     */
    private $activo;
    /** 
     * @Column(name="cargo",length=45, nullable=false)
     */
    private $cargo;
    /**
     *  @Column(name="isAdministrador",type="boolean", nullable=false)
     */
    private $isAdministrador;
    /** 
     * @Column(name="fechaCreacion",type="datetime", nullable=false)
     */
    private $fechaCreacion;
    /** 
     * @Column(name="fechaModificacion",type="datetime", nullable=false)
     */
    private $fechaModificacion;
    

    /** 
     * Un empleado trabaja en una tienda
     * @ManyToOne(targetEntity="Tienda", inversedBy="empleados") 
     * @JoinColumn(name="Tienda_id", referencedColumnName="id")
     */
    private $tienda;




    public function __construct()
    {
        
    }



    
    /** GETTERS & SETTERS */



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
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of passwd
     *
     * @return  self
     */ 
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Get the value of passwd
     */ 
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of photoPath
     */ 
    public function getPhotoPath()
    {
        return $this->photoPath;
    }

    /**
     * Set the value of photoPath
     *
     * @return  self
     */ 
    public function setPhotoPath($photoPath)
    {
        $this->photoPath = $photoPath;

        return $this;
    }

    
    /**
     * Get the value of activo
     */ 
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set the value of activo
     *
     * @return  self
     */ 
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get the value of cargo
     */ 
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set the value of cargo
     *
     * @return  self
     */ 
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get the value of isAdministrador
     */ 
    public function getIsAdministrador()
    {
        return $this->isAdministrador;
    }

    /**
     * Set the value of isAdministrador
     *
     * @return  self
     */ 
    public function setIsAdministrador($isAdministrador)
    {
        $this->isAdministrador = $isAdministrador;

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
     * Get the value of fechaModificacion
     */ 
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set the value of fechaModificacion
     *
     * @return  self
     */ 
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get un empleado trabaja en una tienda
     */ 
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Set un empleado trabaja en una tienda
     *
     * @return  self
     */ 
    public function setTienda($tienda)
    {
        $this->tienda = $tienda;

        return $this;
    }
}
?>