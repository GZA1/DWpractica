<?php
/** @Entity */
class Ubicación 
{
        
    /**
     * @Id
     * @Column(type="integer")
     */
    private $idUbicacion;
        
    /**
     * @Column(type="integer")
     */
    private $cp;
        
    /**
     * @Column(length=45)
     */
    private $municipio;
        
    /**
     * @Column(length=45)
     */
    private $provincia;
        
    /**
     * @Column(length=45)
     */
    private $comunidadAutonoma;
        
    /**
     * @Column(type="float")
     */
    private $latitud;
    /**
     * @Column(type="float")
     */
    private $longitud;
}
?>