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
    public function añadirTienda($tienda){
        
        
        $elNombre =  $tienda->getNombre();
        $elDireccion = $tienda->getDireccion();
        $elEmail = $tienda->getEmail();
        $elCP = $tienda->getCp();
        $elLatitud =  $tienda->getLatitud();
        $elLongitud = $tienda->getLongitud();
        $elProvincia = $tienda->getProvincia();
        $elMuniicipio = $tienda->getMunicipio(); 
        
        cLog($elLatitud);
        
        try{

            $conn = db();
            $consulta = "INSERT INTO Tienda (nombre, direccion, email, cp, latitud, longitud, provincia, municipio) 
                            VALUES (:nombre, :direccion, :email, :cp, :latitud, :longitud, :provincia, :municipio)";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':nombre', $elNombre, PDO::PARAM_STR, 45 );
            $stmt->bindParam(':direccion', $elDireccion, PDO::PARAM_STR, 45);
            $stmt->bindParam(':email',   $elEmail,  PDO::PARAM_STR, 45);
            $stmt->bindParam(':cp', $elCP, PDO::PARAM_INT);
            $stmt->bindParam(':latitud', $elLatitud, PDO::PARAM_STR, 45);
            $stmt->bindParam(':longitud', $elLongitud, PDO::PARAM_STR, 45);
            $stmt->bindParam(':provincia', $elProvincia, PDO::PARAM_STR, 45);
            $stmt->bindParam(':municipio', $elMuniicipio, PDO::PARAM_STR, 45);
            $stmt->execute();
            return true;

        }catch(PDOException $ex){
            cLog($ex->getMessage());
            return false;
        }
    }

}