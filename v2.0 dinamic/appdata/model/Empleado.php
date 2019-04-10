<?php 
require_once("Console.php");
require_once("Cliente.php");

class Empleado extends Usuario {
    private $photoPath;
    private $active;
    private $cargo;
    private $isAdministrador;

    public function __construct(){
        parent::__construct();
        if($this->id == null){
            $this->generateId();
        }
        $this ->tipo = "empleado";
    }

    public function __construct1($id){
        $this->id = $id;
        $this->getEmpleadoByID();
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
            $this->photoPath = $row['photoPath'];
            $this->active = $row['active'];
            $this->cargo = $row['cargo'];
            $this->isAdministrador = $row['isAdministrador'];

            console_log($row);

        }catch(PDOException $ex){
            console_log($ex->getMessage());
        }
    }

    public function registrarEmpleado($empleado){
        if($this->isAdministrador){
            
            try{

                $conn = db();
                $consulta = "INSERT INTO Empleado (id, username, passwd, nombre, apellidos, photopath, cargo) 
                                VALUES (:id, :username, :passwd, :nombre, :apellidos, :photopath, :cargo)";
                $stmt = $conn->prepare($consulta);
                $stmt->bindParam(':id', $empleado->id, PDO::PARAM_STR, 45);
                $stmt->bindParam(':username', $empleado->username ,PDO::PARAM_STR, 45 );
                $stmt->bindParam(':passwd', $empleado->passwd , PDO::PARAM_STR, 45);
                $stmt->bindParam(':nombre', $empleado->nombre ,  PDO::PARAM_STR, 45);
                $stmt->bindParam(':apellidos', $empleado->apellidos, PDO::PARAM_STR, 45);
                $stmt->bindParam(':photopath', $empleado->photopath, PDO::PARAM_STR, 45);
                $stmt->bindParam(':cargo', $empleado->cargo, PDO::PARAM_STR, 45);
                $stmt->execute();
                return true;
                //--TODO

            }catch(PDOException $ex){cLog($ex->getMessage();)}
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
}


?>