<?php 

class Tienda{
    private $id;
    private $nombre;
    private $direccion;
    private $email;
    private $cp;
    private $latitud;
    private $longitud;
    private $provincia;
    private $municipio;

    public function __construct(){
        
        $numArgs = func_num_args();
        $args = func_get_args();
        if( $numArgs==0 ){
            $this->generateId();
        }else if( $numArgs==1 ){
            $this->id = $args[0];
            $this->getTiendaByID();
        }
        
    }

    private function generateId(){
        $this ->id = "SHP:" . spl_object_hash($this);
    }
    
    public function getTiendaByID(){
        $conn = db();
        $consulta = "SELECT * FROM Tienda WHERE id = :id";
        try{

            console_log("id tienda a buscar: ");
            console_log($this->id);
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
            $stmt->execute();            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->nombre = $row['nombre'];
            $this->direccion = $row['direccion'];
            $this->email = $row['email'];
            $this->cp = $row['cp'];
            $this->latitud = $row['lat'];
            $this->longitud = $row['long'];
            $this->provincia = $row['provincia'];
            $this->municipio = $row['municipio'];

            console_log($row);

        }catch(PDOException $ex){
            cLog($ex->getMessage());
        }
    }

    


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
}

?>