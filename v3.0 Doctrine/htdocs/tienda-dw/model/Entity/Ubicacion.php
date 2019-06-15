<?php

namespace Entity;

/**
 * @Table("ubicacion")
 * @Entity(repositoryClass="Repository\UbicacionRepository")
 */

class Ubicacion 
{
        
    /**
     * @Id @GeneratedValue
     * @Column(name="idUbicacion", type="integer", nullable=false)
     */
    private $idUbicacion;
        
    /**
     * @Column(name="cp", type="integer", nullable=false)
     */
    private $cp;
        
    /**
     * @Column(name="municipio", length=45, nullable=false)
     */
    private $municipio;
        
    /**
     * @Column(name="provincia", length=45, nullable=true)
     */
    private $provincia;
        
    /**
     * @Column(name="comunidadAutonoma", length=45, nullable=true)
     */
    private $comunidadAutonoma;
        
    /**
     * @Column(name="latitud", type="float", nullable=true)
     */
    private $latitud;
    /**
     * @Column(name="longitud", type="float", nullable=true)
     */
    private $longitud;
    /** 
     * Una ubicacion es d
     * @OneToMany(targetEntity="Tienda", mappedBy="ubicacion") 
     */
    private $tiendas;

     public function __construct()
     {
        $this->tiendas = new \Doctrine\Common\Collections\ArrayCollection();  
        $this->clientes = new \Doctrine\Common\Collections\ArrayCollection();  
     }













/** GETTERS & SETTERS */


    /**
     * Get the value of idUbicacion
     */ 
    public function getIdUbicacion()
    {
        return $this->idUbicacion;
    }

    /**
     * Set the value of idUbicacion
     *
     * @return  self
     */ 
    public function setIdUbicacion($idUbicacion)
    {
        $this->idUbicacion = $idUbicacion;

        return $this;
    }

    /**
     * Get the value of cp
     */ 
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of municipio
     */ 
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set the value of municipio
     *
     * @return  self
     */ 
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get the value of provincia
     */ 
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set the value of provincia
     *
     * @return  self
     */ 
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get the value of comunidadAutonoma
     */ 
    public function getComunidadAutonoma()
    {
        return $this->comunidadAutonoma;
    }

    /**
     * Set the value of comunidadAutonoma
     *
     * @return  self
     */ 
    public function setComunidadAutonoma($comunidadAutonoma)
    {
        $this->comunidadAutonoma = $comunidadAutonoma;

        return $this;
    }

    /**
     * Get the value of latitud
     */ 
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set the value of latitud
     *
     * @return  self
     */ 
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get the value of longitud
     */ 
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set the value of longitud
     *
     * @return  self
     */ 
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get una ubicacion es d
     */ 
    public function getClientes()
    {
        return $this->clientes;
    }

    /**
     * Set una ubicacion es d
     *
     * @return  self
     */ 
    public function setClientes($clientes)
    {
        $this->clientes = $clientes;

        return $this;
    }

    /**
     * Get una ubicacion es d
     */ 
    public function getTiendas()
    {
        return $this->tiendas;
    }

    /**
     * Set una ubicacion es d
     *
     * @return  self
     */ 
    public function setTiendas($tiendas)
    {
        $this->tiendas = $tiendas;

        return $this;
    }

}
    
?>