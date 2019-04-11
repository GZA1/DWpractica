<?php

require_once("Console.php");


class Cliente extends Usuario {

     
   
    private $domicilio;
    private $saldo;
    private $cesta;

    public function __construct(){
        parent::__construct();
        $params = func_get_args();
        $numParams = func_num_args();
        $funcionContructor = '__construct'.$numParams;
        if(method_exists($this, $funcionContructor)){
            call_user_func_array(array($this, $funcionContructor), $params);
        }
    }

    public function __construct0(){
        if($this->id == null){
            $this->generateId();
        }
        $this->tipo = "cliente";
    }

    public function __construct1($id){
        $this->id = $id;
        $this->getDataClienteId();
        $this->tipo = "cliente";
    }

    public function add(){
        try {
            if( $this->isUser() ){
                return false;
            }

            $conn = db();
            
            $consulta = "insert into cliente (
                    id, username, passwd, nombre, apellidos, 
                    email, domicilio, Cesta_id)
                    values ( :id, :username, :passwd, :nombre, :apellidos, :email,
                    :domicilio, :Cesta_id)";
            
            $cesta_id = null;

            console_log($this->id);
            console_log($this->tipo);
            
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
            $stmt->bindParam(':username', $this->username, PDO::PARAM_STR, 45);
            $stmt->bindParam(':passwd', $this->passwd, PDO::PARAM_STR, 45);
            $stmt->bindParam(':nombre', $this->nombre, PDO::PARAM_STR, 45);
            $stmt->bindParam(':apellidos', $this->apell, PDO::PARAM_STR, 45);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR, 45);
            $stmt->bindParam(':domicilio', $this->domicilio, PDO::PARAM_STR, 45);
            $stmt->bindValue(':Cesta_id', null, PDO::PARAM_INT);            
            $stmt->execute();

            return true;
            
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    /** 
   * Obtiene todos los empleados 
   * 
   *  @return array 
   */
   
   public function get_all()
   {
        $conn = db();
        
        $clientes = [];
        
        $consulta = "SELECT * FROM cliente";
        try{
            
            $stmt = $conn->query($consulta);
            
        }catch(PDOException $ex){
            console_log($ex->getMessage());
        }

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $clientes[] = [
                'id' => $row['id'],
                'username' => $row['username'],
                'passwd' => $row['passwd'],
                'nombre' => $row['nombre'],
                'apellidos' => $row['apellidos'],
                'email' => $row['email'],
                'domicilio' => $row['domicilio'],
                'fechaCreacion' => $row['fechaCreacion'],
                'fechaModificacion' => $row['fechaModificacion'],
                'Cesta_id' => $row['Cesta_id']
            ];
        }
        return $clientes;
         
    }


    private function getDataClienteId(){
        $conn = db();
        $consulta = "SELECT * FROM cliente WHERE id = :id";
        try{

            console_log("id cliente a buscar: ");
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
            $this->domicilio = $row['domicilio'];
            $this->saldo = $row['saldo'];
            $this->cesta = $row['Cesta_id'];

            console_log($row);

        }catch(PDOException $ex){
            console_log($ex->getMessage());
        }
    }

    
    private function generateId(){
        $this ->id = "CLI:" . spl_object_hash($this);
    }

    public function updatePerfilCliente($username, $name, $surnames, $address)  {
        
        if(isset($username) & isset($name) && isset($surnames) && isset($address)){

            try{
                $dateTime = date("Y-m-d H:i:s"); 

                $conn = db();
                $consulta = "UPDATE Cliente SET username = :Username, nombre = :Nombre, apellidos = :Apellidos, domicilio = :Domicilio, fechaModificacion = :FechaModificacion WHERE id = :id";
                $stmt = $conn->prepare($consulta);
                $stmt->bindParam(':Username', $username, PDO::PARAM_STR, 45);
                $stmt->bindParam(':Nombre', $name, PDO::PARAM_STR, 45);
                $stmt->bindParam(':Apellidos', $surnames, PDO::PARAM_STR, 45);
                $stmt->bindParam(':Domicilio', $address, PDO::PARAM_STR, 45);
                $stmt->bindParam(':FechaModificacion', $dateTime);
                $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
                $stmt->execute();
            }catch(PDOException $ex){cLog($ex->getMessage());}
         return true;   
        }else{
            return false;
        }

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
     * Get the value of domicilio
     */ 
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set the value of domicilio
     *
     * @return  self
     */ 
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }



    /**
     * Get the value of saldo
     */ 
    public function getSaldo()
    {
        return number_format(floatval($this->saldo),2);
    }

    /**
     * Set the value of saldo
     *
     * @return  self
     */ 
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Add the value of $value to saldo,
     * which is written in the mysql db
     */ 
    public function addSaldo($value)
    {
        $this->saldo += $value;
        return $this->updateSaldo();
    }

    /**
     * Update saldo in the mysql db
     */
    private function updateSaldo(){
        try{

            $conn = db();
            $consulta = "UPDATE cliente SET saldo = :saldo WHERE id = :id";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':saldo', $this->saldo, PDO::PARAM_STR, 45);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 45);
            $stmt->execute();   

        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    /**
     * Get the value of cesta
     */ 
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set the value of cesta
     *
     * @return  self
     */ 
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }
}

?>