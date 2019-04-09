<?php

require_once("Console.php");
require_once("Cliente.php");
require_once("config.php");
class Usuario{
    protected $id = null;
    protected $username;
    protected $passwd;
    protected $nombre;
    protected $apell;
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
        $conn = db();
        
        $consulta = "SELECT id FROM " . $this->tipo . " WHERE username = :username AND passwd = :passwd";
        $stmt = $conn->prepare($consulta);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR, 45);
        $stmt->bindParam(':passwd', $this->passwd, PDO::PARAM_STR, 45);
        $stmt->execute();

        $output = $stmt->fetch(PDO::FETCH_ASSOC);
        if( ! $output ){
            return false;
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
        $idTipo = substr($this->id, 0, 2);
        if(strcmp($idTipo, "CLI")){
            $tipo = "cliente";
        }else if(strcmp($idTipo, "EMP")){
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
        console_log($row);
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
        $users = $this->getAllUsers();
        foreach($users as $k => $u){
            if($this->id == $k){

                //Comentado hasta que funcione ! ! ! ! ! ! ! ! ! ! ! ! ! ! ! ! !

                /*$uorig = new Usuario();
                $uorig->setUsername(json_decode($u, true)['username'])
                    ->setPasswd($newPasswd)
                    ->setTipo(json_decode($u, true)['tipo'])
                    ->setEmail(json_decode($u, true)['email'])
                ;
                $users[$k] = $uorig;
                file_put_contents( Usuario::$usersPath, json_encode($users, JSON_PRETTY_PRINT) );*/
                
                return true;
            }
        }
        return false;
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

    public function encryptPasswd()
    {
        $this->passwd = sha1($this->passwd); //Hasheamos la contraseña del usuario

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