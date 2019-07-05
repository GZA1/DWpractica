<?php

namespace Entity;

/**
 * @Entity(repositoryClass="Repository\TiendaRepository")
 */

class Tienda 
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @Column(name="nombre", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @Column(name="direccion", length=45, nullable=false)
     */
    private $direccion;

    
    /**
     * @Column(name="email", length=45, nullable=false)
     */
    private $email;


    /** 
     * una tienda tiene una ubicacion
     * @ManyToOne(targetEntity="Ubicacion", inversedBy="tiendas") 
     * @JoinColumn(name="Ubicacion_idUbicacion", referencedColumnName="idUbicacion")
     */
    private $ubicacion;

    /** 
     * Una tienda tiene muchos empleados
     * @OneToMany(targetEntity="Empleado", mappedBy="tienda")
     */
    private $empleados;

    /** 
     * Una tienda tiene muchas unidades
     * @OneToMany(targetEntity="Unidad", mappedBy="tienda")
     */
    private $unidades;



    public function __construct()
    {
        $this->empleados = new \Doctrine\Common\Collections\ArrayCollection();  
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();  
        
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
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

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
     * Get uno o varios clientes tienen una ubicacion
     */ 
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set uno o varios clientes tienen una ubicacion
     *
     * @return  self
     */ 
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get una tienda tiene muchos empleados
     */ 
    public function getEmpleados()
    {
        return $this->empleados;
    }

    /**
     * Set una tienda tiene muchos empleados
     *
     * @return  self
     */ 
    public function setEmpleados($empleados)
    {
        $this->empleados = $empleados;

        return $this;
    }

    /**
     * Get una tienda tiene muchas unidades
     */ 
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set una tienda tiene muchas unidades
     *
     * @return  self
     */ 
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }
}
?>