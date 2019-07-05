<?php 

class Tienda{
    private $id;
    private $nombre;
    private $direccion;
    private $email;
    private $idUbicacion;

    public function __construct(){
        
        $numArgs = func_num_args();
        $args = func_get_args();
        if( $numArgs==1 ){
            $this->id = $args[0];
            $this->getTiendaByID();
        }
        
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
            $this->idUbicacion = $row['idUbicacion'];

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
}

?>