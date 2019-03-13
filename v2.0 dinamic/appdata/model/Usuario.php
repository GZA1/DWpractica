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
        if( !is_file(Usuario::$usersPath) || empty(Usuario::getAllUsers()) ){
            console_log("Estaba vacío");
            $users[$this->id] = $this->toJson();
            console_log($users);
            file_put_contents( Usuario::$usersPath, $users );
        }else if( !$this->isUser() ){
            console_log("Add user");
            $users = Usuario::getAllUsers();
            $users[$this->id] = $this->toJson();
            console_log($users);
            file_put_contents( Usuario::$usersPath, $users );
        }else{
            return false;
        }
        return true;
    }
    
    public static function getAllUsers(){
        $users = [];
        $data = json_decode(file_get_contents((Usuario::$usersPath), true));
        console_log($data); //El array de datos de todos los usuarios
        foreach($data as &$d) {
            console_log("d: ");
            console_log($d); //Cada objeto Usuario
            $users[$d->id] = $d;
        }
        console_log("Res ");
        console_log($users);
        return $users;
    }

    private function isUser(){
        $users = Usuario::getAllUsers();
        console_log($users[$this->id]);
        return $users[$this->id];
    }

    public function toJson(){
        return json_encode([
           'id' => $this->id,
           'username' => $this->username,
           'passwd' => $this->passwd,
           'nombre' => $this->nombre,
           'apell' => $this->apell,
           'email' => $this->email
        ]);
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
        $this->passwd = sha1($passwd); //Hasheamos la contraseña del usuario

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








    
}
?>