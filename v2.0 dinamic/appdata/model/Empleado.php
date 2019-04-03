<?php 
require_once("Console.php");
require_once("Cliente.php");

class Empleado extends Usuario {
    private $photoPath;
    private $active;
    private $cargo;
    private $isAdministrador;

    public function __construct(){
        parent::_construct();
        $this ->id = spl_object_hash($this);
        $this ->tipo = "empleado";
    }


    

}


?>