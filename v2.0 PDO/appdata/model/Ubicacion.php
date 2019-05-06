<?php


class Ubicacion { 

    protected $idUbicacion;
    protected $cp;
    protected $municipio;
    protected $provincia;
    protected $comunidadAutonoma;
    protected $latitud;
    protected $longitud;

    public function __construct(){
        console_log("Ubicacion creada");
        console_log($this);
    }




    public function searchIdByCpMunic(){
        try{
            $conn = db();
            
            $consulta = 
                "SELECT idUbicacion
                    FROM Ubicacion
                    WHERE cp = :cp AND municipio = :municipio";
            try{
                
                $stmt = $conn->prepare($consulta);
                $stmt->bindParam(':cp', $this->cp, PDO::PARAM_INT);
                $stmt->bindParam(':municipio', $this->municipio, PDO::PARAM_STR, 80);
                $stmt->execute();
                
            }catch(PDOException $ex){
                console_log($ex->getMessage());
            }

            $this->idUbicacion = $stmt->fetch(PDO::FETCH_ASSOC)['idUbicacion'];
            console_log($this->idUbicacion);
            return $this->idUbicacion;
        }catch(PDOException $ex){
            cLog($ex.getMessage());
            return false;
        }
    }




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