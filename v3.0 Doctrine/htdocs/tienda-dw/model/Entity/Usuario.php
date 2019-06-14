<?php

namespace Entity;

/**
 * @Entity(repositoryClass="Repository\UsuarioRepository")
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="tipo", type="string")
 * @DiscriminatorMap({"usuario" = "Usuario", "cliente" = "Cliente", "empleado" = "Empleado"})
 */

class Usuario
{
    /** 
     * @Id
     * @Column(name="idUsuario",type="integer", nullable=false)
     * @GeneratedValue(strategy="NONE")
    */
    protected $idUsuario;
    /** 
     * @Column(name="username",length=45, nullable=false, unique=true)
    */
    protected $username;
    /** 
     * @Column(name="passwd",length=45, nullable=false)
    */
    protected $passwd;
    /** 
     * @Column(name="nombre",length=45, nullable=false) 
    */
    protected $nombre;
    /** 
     * @Column(name="apellidos",length=45, nullable=false) 
    */
    protected $apellidos;
    /** 
     * @Column(name="email",length=45, nullable=false, unique=true)
    */
    protected $email;

    protected $tipo;

    /** 
     * @Column(name="fechaCreacion",type="datetime", nullable=false)
     */
    protected $fechaCreacion;
    /** 
     * @Column(name="fechaModificacion",type="datetime", nullable=false)
     */
    protected $fechaModificacion;




    public function __construct(){
    }

    
    /** GETTERS & SETTERS */



    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */ 
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

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
     * Get the value of passwd
     */ 
    public function getPasswd()
    {
        return $this->passwd;
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
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

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
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Get the value of fechaModificacion
     */ 
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
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



    /** METHODS */

    
    public function login(){
        
        try{
            
            $conn = db();
            
            if( preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $this->username) ){

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

}
?>