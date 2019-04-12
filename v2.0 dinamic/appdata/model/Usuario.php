<?php

require_once("Console.php");
require_once("Cliente.php");
require_once("config.php");


class Usuario { 

    protected $id = null;
    protected $username;
    protected $passwd;
    protected $nombre;
    protected $apell;
    protected $email;
    protected $tipo;

    public function __construct(){
        $params = func_get_args();
        $numParams = func_num_args();
        $funcionContructor = '__construct'.$numParams;
        if(method_exists($this, $funcionContructor)){
            call_user_func_array(array($this, $funcionContructor), $params);
        }
    }

    public function __construct0(){
    }

    public function __construct1($id){
        $this->id = $id;
        $this->tipo = $this->getTipoById();
        $this->username = $this->getUsernameById();
    }

    

    public function login(){
        
        try{
            
            $conn = db();
            
            if(strpos($this->username, '@') !== FALSE){
                
                $consulta = "SELECT id FROM Cliente WHERE email = :username AND passwd = :passwd";
                
            }else {
                
                $consulta = "SELECT id FROM Cliente WHERE username = :username AND passwd = :passwd";
    
            }
            
            
            
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR, 45);
            $stmt->bindParam(':passwd', $this->passwd, PDO::PARAM_STR, 45);
            $stmt->execute();
            
            $output = $stmt->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $ex){cLog($ex.getMessage());}
        if( ! $output ){
            try{
                $consulta = str_replace("Cliente","Empleado", $consulta);
                //cLog($consulta);
                $stmt2 = $conn->prepare($consulta);
                $stmt2->bindParam(':username', $this->username, PDO::PARAM_STR, 45);
                $stmt2->bindParam(':passwd', $this->passwd, PDO::PARAM_STR, 45);
                $stmt2->execute();
                $output2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $ex){cLog($ex.getMessage());}
                
            if(! $output2){

                return false;
            }else{
                $this->id = $output2['id'];
                return true;
            }
        }else{
            $this->id = $output['id'];
            return true;
        }
    }

    public function isUser(){
        $conn = db();
        
        $consulta = "SELECT id FROM " . $this->tipo . " WHERE username = :username";
        $stmt = $conn->prepare($consulta);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR, 45);
        $stmt->execute();

        if( ! $stmt->fetch(PDO::FETCH_ASSOC) ){
              return false;
        }else{
              return true;
        }
    }

    public function getTipoById(){
        // cLog($this->id);
        $idTipo = substr($this->id, 0, 3);
        if(strcmp($idTipo, "CLI") == 0){
            $tipo = "cliente";
        }else if(strcmp($idTipo, "EMP") == 0){
            $tipo = "empleado";
        }
        return $tipo;
    }

    public function getUsernameById(){
        $conn = db();
        
        console_log($this->id);
        $consulta = "SELECT username FROM " . $this->tipo . " WHERE id = :id";
        $stmt = $conn->prepare($consulta);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if( ! $row ){
            return false;
        }else{
            return $row['username'];
        }
    }

    




    //RecuperarElUsuarioLogeado
    public function getLoggedUser() {
        $username = $this->getUsernameByID();
        $this->setUsername($username);
        return $this->getUser();
    }
    


    public function changePasswd($newPasswd){
        try{
            $conn = db();
            
            $consulta = "UPDATE " . $this->tipo . " SET passwd = :passwd WHERE id = :id";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':passwd', sha1($newPasswd), PDO::PARAM_STR, 45);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
            $stmt->execute();

            return true;
        }catch(PDOException $ex){
            cLog($ex.getMessage());
            return false;
        }
    }
    

    public function compararPass($pass){
        if( ! isset($this->passwd) ){
            $this->passwd = $this->getPasswdFromDB();
            console_log($pass);
            console_log($this->passwd);
        }
        if($this->passwd == $pass){
            console_log("true");
            return true;
        }else{
            console_log("false");
            return false;
        }
    }

    private function getPasswdFromDB(){
        try{
            $conn = db();
        
            $consulta = "SELECT passwd FROM " . $this->tipo . " WHERE id = :id";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
            $stmt->execute();
    
            return $stmt->fetch(PDO::FETCH_ASSOC)['passwd'];
        }catch(PDOException $ex){
            cLog($ex.getMessage());
        }
    }
    
    
    public function encryptPasswd()
    {
        $this->passwd = sha1($this->passwd); //Hasheamos la contraseña del usuario

        return $this;
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
     * Get the value of apell
     */ 
    public function getApell()
    {
        return $this->apell;
    }

    /**
     * Set the value of apell
     *
     * @return  self
     */ 
    public function setApell($apell)
    {
        $this->apell = $apell;

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
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}
?>