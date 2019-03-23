<?php

    require_once("Console.php");

    class Cliente extends Usuario {
        private $domicilio;
        private $monedero;
        private $cesta;
        private $pedidos;

        public function __construct()
        {
            parent::__construct();
            $this->tipo = "cliente";
        }

        /*Metodo add, no recibe parámetros*/

        public function add(){
            $users = [];
            if( !is_dir(dirname(Usuario::$UsersPath)) )
                mkdir(dirname(Usuario::$UsersPath), 0755);
            if( !$this->getUser() || !$this->getUserByMail() ){
                $users = $this->getAllUsers();
                $users[$this->id] = $this->toJson();
                file_put_contents( Usuario::$UsersPath, json_encode($users, JSON_PRETTY_PRINT) );
            }else{
                return false;
            }
            return true;
        }



        public function getAllUsers(){
            return (array)json_decode(file_get_contents((Usuario::$UsersPath), true));
        }


        public function toJson(){
            return json_encode([
                "username" => $this->username,
                "passwd" => $this->passwd,
                "nombre" => $this->nombre,
                "apell" => $this->apell,
                "email" => $this->email,
                "domicilio" => $this->domicilio
             ]);
        }

        public static function fromJson($json){
            $array = json_decode($json, true);
            $obj = new Cliente();
            $obj->setId(key($array))
                ->setUsername($array['username'])
                ->setPasswd($array['passwd'])
                ->setNombre($array['nombre'])
                ->setApell($array['apell'])
                ->setEmail($array['email'])
                ->setdomicilio($array['domicilio'])
            ;
            console_log($obj);
            console_log($array);
            return $obj;
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

    }

?>
