<?php

require_once("Console.php");
require_once("Cliente.php");

class Usuario{
    public static $usersPath = '/xampp/appdata/data/users.json';
    protected $id;
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
        }else{
            console_log("No existe");
        }
    }

    public function __construct0(){
        
    }

    public function __construct1($id){
        $this->id = $id;
    }


    public function login(){
        console_log("login");
        console_log($this->username);
        console_log($this->passwd);
        $u = $this->getUser();
        if( $u !== null && $u->passwd == $this->passwd ){
            console_log("Bien");
            console_log($u->getId());
            return true;
        }else{
            $this->setEmail($this->username);
            console_log("Email");
            console_log($this->email);
            console_log($u);
            $u = $this->getUserByMail();
            console_log($u);
            if( $u !== null && $u->passwd == $this->passwd ){
                return true;
            }else{
                return false;
            }
        }
    }

    public function getUser(){
        console_log('getUser: ');
        $users = $this->getAllUsers();
        foreach($users as $k => $u){
            $u = $this->fromJson($u);
            if( $u->username == $this->username ){
                $this->id = $k;
                $k = $u->id;
                return $u;
            }
        }
        return null;
    }

    public function getUserByMail(){
        console_log('getUserByMail: ');
        $users = $this->getAllUsers();
        foreach($users as $k => $u){
            $u = $this->fromJson($u);
            if( $u->email == $this->email ){
                $this->id = $k;
                $k = $u->id;
                return $u;
            }
        }
        return null;
    }

    public function getAllUsers(){
        return (array)json_decode(file_get_contents((Usuario::$usersPath), true));
    }

    public function toJson(){
        return json_encode([
            "username" => $this->username,
            "passwd" => $this->passwd,
            "email" => $this->email
         ]);
    }

    public static function fromJson($json){
        $array = json_decode($json, true);
        $obj = new Usuario();
        $obj->setUsername($array['username'])
            ->setPasswd($array['passwd'])
            ->setTipo($array['tipo'])
            ->setEmail($array['email'])
            ->setNombre($array['nombre'])
            ->setApell($array['apell'])
        ;
        return $obj;
    }

    public function getUsernameById(){
        foreach($this->getAllUsers() as $k => $u){
            if($this->id == $k)
                return json_decode($u, true)['username'];
        }
        return null;
    }

    public function getTipoById(){
        foreach($this->getAllUsers() as $k => $u){
            if($this->id == $k)
                return json_decode($u, true)['tipo'];
        }
        return null;
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