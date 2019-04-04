<?php
    require_once("Console.php");


    class ClientePDO extends Usuario {
        private $domicilio;
        private $saldo;
        private $cesta;
        private $pedidos;

        public function __construct()
        {
            parent::__construct();
            $this->id = spl_object_hash($this);
            $this->tipo = "cliente";



            public function add(){

                

            }
        }        
    }

?>