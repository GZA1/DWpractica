<?php

namespace Entities;

/** @Entity */
class Cliente 
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
     * 
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
     * @Column(name="domicilio",length=45, nullable=true)
     */
    private $domicilio;
    /**
     * @Column(name="saldo",type="float", nullable=false)
     */
    private $saldo;
    /**
     * @Column(name="fechaCreacion",type="datetime", nullable=false)
     */
    private $fechaCreacion;
    /**
     * @Column(name="fechaModificacion",type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /** 
     * Un cliente tienen una ubicacion
     * @ManyToOne(targetEntity="Ubicacion", inversedBy="clientes") 
     * @JoinColumn(name="Ubicacion_idUbicacion", referencedColumnName="idUbicacion")
     */
    private $ubicacion;
    
    /**
     * Una cesta tiene un cliente
     * @OneToOne(targetEntity="Cesta", mappedBy="cliente")
     */
    private $cesta;


    

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
     * Get the value of passwd
     */ 
    public function getPasswd()
    {
        return $this->passwd;
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
     * Get the value of domicilio
     */ 
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set the value of domicilio
     *
     * @return  self
     */ 
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get the value of saldo
     */ 
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set the value of saldo
     *
     * @return  self
     */ 
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

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
     * Get un cliente tienen una ubicacion
     */ 
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set un cliente tienen una ubicacion
     *
     * @return  self
     */ 
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get una cesta tiene un cliente
     */ 
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set una cesta tiene un cliente
     *
     * @return  self
     */ 
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }
}
?>