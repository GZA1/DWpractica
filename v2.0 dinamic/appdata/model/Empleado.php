<?php 
require_once("Console.php");
require_once("Cliente.php");

class Empleado extends Usuario {
    private $photoPath;
    private $active;
    private $cargo;
    private $isAdministrador;

    public function __construct(){
        parent::__construct();
        if($this->id == null){
            $this->generateId();
        }
        $this ->tipo = "empleado";
    }


    private function generateId(){
        $this ->id = "EMP:" . spl_object_hash($this);
    }

}


?>