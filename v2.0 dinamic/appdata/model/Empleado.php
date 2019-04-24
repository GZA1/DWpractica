<?php 
require_once("Console.php");
require_once("Cliente.php");
require_once("Admin.php");

class Empleado extends Usuario {
    protected $photoPath;
    protected $active;
    protected $cargo;
    protected $isAdministrador;
    protected $tienda_id;



    public function __construct(){
        parent::__construct();
        $numArgs = func_num_args();
        $args = func_get_args();
        if( $numArgs==0 ){
            $this->generateId();
        }else if( $numArgs==1 ){
            $this->id = $args[0];
            $this->getEmpleadoByID();
        }
        $this ->tipo = "empleado";
    }
    
    private function generateId(){
        $this ->id = "EMP:" . spl_object_hash($this);
    }

    public function getEmpleadoByID(){
        $conn = db();
        $consulta = "SELECT * FROM Empleado WHERE id = :id";
        try{

            console_log("id empleado a buscar: ");
            console_log($this->id);
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->username = $row['username'];
            $this->passwd = $row['passwd'];
            $this->nombre = $row['nombre'];
            $this->apell = $row['apellidos'];
            $this->email = $row['email'];
            $this->photoPath = $row['photoPath'];
            $this->active = $row['activo'];
            $this->cargo = $row['cargo'];
            $this->isAdministrador = $row['isAdministrador'];
            $this->tienda_id = $row['Tienda_id'];


            console_log($row);
            
        }catch(PDOException $ex){
            cLog($ex->getMessage());            
        }
    }

    public function updatePerfilEmpleado($username, $name, $surnames)  {
        if(isset($username) & isset($name) && isset($surnames)){
            try{
                $conn = db();
                $consulta = "UPDATE Empleado SET username = :Username, nombre = :Nombre, apellidos = :Apellidos WHERE id = :id";
                $stmt = $conn->prepare($consulta);
                $stmt->bindParam(':Username', $username, PDO::PARAM_STR, 45);
                $stmt->bindParam(':Nombre', $name, PDO::PARAM_STR, 45);
                $stmt->bindParam(':Apellidos', $surnames, PDO::PARAM_STR, 45);
                $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
                $stmt->execute();
            }catch(PDOException $ex){cLog($ex->getMessage());}
         return true;   
        }else{
            return false;
        }

    }

    public function doIDexist($id){
        
        $conn = db();
        try{
            $consulta="SELECT COUNT(*) FROM Empleado WHERE id=:id";
            $stmt = $conn->cprepare($consulta);
            $stmt-bindParam(':id', $id, PDO::PARAM_STR, 45);
            $stmt->execute();
            $row = $stmt->fetch();
        }catch(PDOException $ex){
            cLog($ex);
        }
        if($row[0] > 0){
            return true;
        }else{
            return false;
        }

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
     * Get the value of active
     */ 
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @return  self
     */ 
    public function setActive($active)
    {
        $this->active = $active;

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
     * Get the value of tienda_id
     */ 
    public function getTienda_id()
    {
        return $this->tienda_id;
    }

    /**
     * Set the value of tienda_id
     *
     * @return  self
     */ 
    public function setTienda_id($tienda_id)
    {
        $this->tienda_id = $tienda_id;

        return $this;
    }
}


?>