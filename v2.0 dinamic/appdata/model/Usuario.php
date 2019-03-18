<?php

require_once("Console.php");

class Usuario{
    protected $id;
    protected $username;
    protected $passwd;
    protected $nombre;
    protected $apell;
    protected $email;
    protected $path;

    public function __construct(){
        $this->id = spl_object_hash($this);
    }

    public function __construct1($id, $username, $passwd, $nombre, $apell, $email){
        $this->id = spl_object_hash($this);
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
        $users = $this->getAllUsers();
        console_log($users);
        foreach($users as &$u){
            $u = $this->fromJson($u);
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
        $users = $this->getAllUsers();
        console_log($users);
        foreach($users as &$u){
            $u = $this->fromJson($u);
            console_log('u: ');
            console_log($u);
            if( $u->email == $this->email ){
                return $u;
            }
        }
        return null;
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