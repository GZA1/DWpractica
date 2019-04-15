<?php 
require_once("Console.php");
require_once("Cliente.php");

class Admin extends Empleado {

    public function __construct($id){
        parent::__construct($id);
    }

    public function registrarEmpleado($empleado){
        try{

            $conn = db();
            $consulta = "INSERT INTO Empleado (id, username, passwd, nombre, apellidos, email, photopath, cargo) 
                            VALUES (:id, :username, :passwd, :nombre, :apellidos, :email, :photopath, :cargo)";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $empleado->id, PDO::PARAM_STR, 45);
            $stmt->bindParam(':username', $empleado->username ,PDO::PARAM_STR, 45 );
            $stmt->bindParam(':passwd', $empleado->passwd , PDO::PARAM_STR, 45);
            $stmt->bindParam(':nombre', $empleado->nombre ,  PDO::PARAM_STR, 45);
            $stmt->bindParam(':apellidos', $empleado->apell, PDO::PARAM_STR, 45);
            $stmt->bindParam(':email', $empleado->email, PDO::PARAM_STR, 45);
            $stmt->bindParam(':photopath', $empleado->photoPath, PDO::PARAM_STR, 45);
            $stmt->bindParam(':cargo', $empleado->cargo, PDO::PARAM_STR, 45);
            $stmt->execute();
            return true;

        }catch(PDOException $ex){
            cLog($ex->getMessage());
            return false;
        }
    }
    

}