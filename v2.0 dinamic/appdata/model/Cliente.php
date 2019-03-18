<?php

    require_once("Console.php");

    class Cliente extends Usuario {
        public static $clientesPath = '/xampp/appdata/data/clientes.json';
        private $direccion;
        private $monedero;
        private $cesta;
        private $pedidos;

        public function __construct()
        {
            parent::__construct();
            $this->path = Cliente::$clientesPath;
        }


        public function add(){
            $users = [];
            if( !is_dir(dirname($this->path)) )
                mkdir(dirname($this->path), 0755);
            if( !$this->getUser() || !$this->getUserByMail() ){
                $users = $this->getAllUsers();
                $users[$this->id] = $this->toJson();
                file_put_contents( $this->path, json_encode($users, JSON_PRETTY_PRINT) );
            }else{
                return false;
            }
            return true;
        }

        public function getAllUsers(){
            return (array)json_decode(file_get_contents(($this->path), true));
        }

        public function toJson(){
            return json_encode([
                "id" => $this->id,
                "username" => $this->username,
                "passwd" => $this->passwd,
                "nombre" => $this->nombre,
                "apell" => $this->apell,
                "email" => $this->email,
                "direccion" => $this->direccion
             ]);
        }

        public static function fromJson($json){
            $array = json_decode($json, true);
            $obj = new Cliente();
            $obj->setId($array['id'])
                ->setUsername($array['username'])
                ->setPasswd($array['passwd'])
                ->setNombre($array['nombre'])
                ->setApell($array['apell'])
                ->setEmail($array['email'])
                ->setDireccion($array['direccion'])
            ;
            console_log($obj);
            console_log($array);
            return $obj;
        }
        
        
        
        /**
         * Get the value of direccion
         */ 
        public function getDireccion()
        {
            return $this->direccion;
        }
    
        /**
         * Set the value of direccion
         *
         * @return  self
         */ 
        public function setDireccion($direccion)
        {
            $this->direccion = $direccion;
    
            return $this;
        }

    }

?>