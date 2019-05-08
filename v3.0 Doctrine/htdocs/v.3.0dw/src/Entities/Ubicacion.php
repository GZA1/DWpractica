<?php

namespace Entities;

/** 
 * @Entity
 */
class Ubicación 
{
        
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     */
    private $idUbicacion;
        
    /**
     * @Column(type="integer", nullable=false)
     */
    private $cp;
        
    /**
     * @Column(length=45, nullable=false)
     */
    private $municipio;
        
    /**
     * @Column(length=45, nullable=true)
     */
    private $provincia;
        
    /**
     * @Column(length=45, nullable=true)
     */
    private $comunidadAutonoma;
        
    /**
     * @Column(type="float", nullable=true)
     */
    private $latitud;
    /**
     * @Column(type="float", nullable=true)
     */
    private $longitud;

/** 
     * @ManyToOne(targetEntity="Usuario", inversedBy="carritos") 
     * @JoinColumn(name="usuarios_id", referencedColumnName="id")
     */


     public function __construct()
     {
         
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
}
    
?>