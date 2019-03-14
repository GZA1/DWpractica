<?php

require_once("Console.php");

class Usuario{
    public static $usersPath = '/xampp/appdata/data/users.json';
    private $id;
    private $username;
    private $passwd;
    private $nombre;
    private $apell;
    private $email;

    public function __construct(){
        $this->id = spl_object_hash($this);
    }

    public function add(){
        $users = [];
        if( !is_dir(dirname(Usuario::$usersPath)) )
            mkdir(dirname(Usuario::$usersPath), 0755);
        if( !$this->getUser() || !$this->getUserByMail() ){
            $users = Usuario::getAllUsers();
            $users[$this->id] = $this->toJson();
            file_put_contents( Usuario::$usersPath, json_encode($users, JSON_PRETTY_PRINT) );
        }else{
            return false;
        }
        return true;
    }
    
    public static function getAllUsers(){
        return (array)json_decode(file_get_contents((Usuario::$usersPath), true));
    }

    public function login(){
        console_log("login");
        console_log($this->username);
        console_log($this->passwd);
        $u = $this->getUser();
        if( $u !== null && $u->passwd == $this->passwd ){
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
        $users = Usuario::getAllUsers();
        console_log($users);
        foreach($users as &$u){
            $u = Usuario::fromJson($u);
            console_log('u: ');
            console_log($u);
            if( $u->username == $this->username ){
                return $u;
            }
        }
        return null;
    }

    public function getUserByMail(){
        console_log('getUserByMail: ');
        $users = Usuario::getAllUsers();
        console_log($users);
        foreach($users as &$u){
            $u = Usuario::fromJson($u);
            console_log('u: ');
            console_log($u);
            if( $u->email == $this->email ){
                return $u;
            }
        }
        return null;
    }

    public function toJson(){
        return json_encode([
           "id" => $this->id,
           "username" => $this->username,
           "passwd" => $this->passwd,
           "nombre" => $this->nombre,
           "apell" => $this->apell,
           "email" => $this->email
        ]);
    }

    public static function fromJson($json){
        $array = json_decode($json, true);
        $obj = new Usuario();
        $obj->setId($array['id'])
            ->setUsername($array['username'])
            ->setPasswd($array['passwd'])
            ->setNombre($array['nombre'])
            ->setApell($array['apell'])
            ->setEmail($array['email'])
        ;
        console_log($obj);
        console_log($array);
        return $obj;
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








    
}
?>