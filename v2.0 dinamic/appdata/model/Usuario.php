<?php

require_once("Console.php");
require_once("Cliente.php");

class Usuario{
    public static $UsersPath = '/xampp/appdata/data/users.json';
    protected $id;
    protected $username;
    protected $passwd;
    protected $nombre;
    protected $apell;
    protected $email;
    protected $tipo;

    /*Constructores de la clase Usuario*/

    public function __construct(){
        $this->id = spl_object_hash($this);
    }

    public function __construct1($id, $username, $passwd, $nombre, $apell, $email, $tipo){
        $this->id = spl_object_hash($this);
    }

    /*Metodo login, no recibe parámetros
    comprueba que los credenciales de la instancia actual son correctos y
    se encuentran en la base de datos, si el login es correcto se retorna true,
    si es incorrecto false*/

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
/* ------------------------------TRRRRRRRRASH-------------------------------*/
    public function getUserByID(){
        $users = $this->getAllUsers();
        foreach($users as $key => $this->id){
            $u = $this->fromJson($key);
            console_log('OJO CUIDAO');
            console_log($u);
            
                return $u;
            
        }
        return null;
    }
    /*Metodo getUser,
    No recibe parámetros, utiliza la instancia actual de Usuario y  compara
    su Username con los almacenados en la base de datos, si encuentra una
    coincidencia devuelve el obj. Usuario, si no, null*/

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

    /*Metodo getUserByMail,
    No recibe parámetros, utiliza la instancia actual de Usuario y  compara
    su email con los almacenados en la base de datos, si encuentra una
    coincidencia devuelve el obj. Usuario, si no, null*/

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

    /*Método getAllUsers retorna el array completo de Usuarios en la base de datos*/

    public function getAllUsers(){
        return (array)json_decode(file_get_contents((Usuario::$UsersPath), true));
    }

    /*Funcion toJson, No recibe parámetros, se encarga de codificar la instancia
    usuario actual al archivo Json*/

    public function toJson(){
        return json_encode([
            "username" => $this->username,
            "passwd" => $this->passwd,
            "email" => $this->email
         ]);
    }

    /*Método estático fromJson, recibe como parámetro una ruta Json a decodificar
    devuelve un objecto usuario con los atributos del Json decodificado*/

    public static function fromJson($json){
        $array = json_decode($json, true);
        $obj = new Usuario();
        $obj->setId(key($array))
            ->setUsername($array['username'])
            ->setPasswd($array['passwd'])
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

    /*No recibe parámetros, coge la contraseña de la instancia de usuario actual
    la hashea en SHA1 y devuelve el objeto Usuario*/

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
