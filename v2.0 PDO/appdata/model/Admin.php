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
            $consulta = "INSERT INTO Empleado (id, username, passwd, nombre, apellidos, email, photopath, cargo, tienda_id) 
                            VALUES (:id, :username, :passwd, :nombre, :apellidos, :email, :photopath, :cargo, :tienda_id)";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $empleado->id, PDO::PARAM_STR, 45);
            $stmt->bindParam(':username', $empleado->username ,PDO::PARAM_STR, 45 );
            $stmt->bindParam(':passwd', $empleado->passwd , PDO::PARAM_STR, 45);
            $stmt->bindParam(':nombre', $empleado->nombre ,  PDO::PARAM_STR, 45);
            $stmt->bindParam(':apellidos', $empleado->apell, PDO::PARAM_STR, 45);
            $stmt->bindParam(':email', $empleado->email, PDO::PARAM_STR, 45);
            $stmt->bindParam(':photopath', $empleado->photoPath, PDO::PARAM_STR, 45);
            $stmt->bindParam(':cargo', $empleado->cargo, PDO::PARAM_STR, 45);
            $stmt->bindParam(':tienda_id', $empleado->tienda_id, PDO::PARAM_STR, 45);
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
        $elIdUbicacion = $tienda->getIdUbicacion();

        try{
            $conn = db();
            $consulta = "INSERT INTO Tienda (nombre, direccion, email, Ubicacion_idUbicacion)
                            VALUES (:nombre, :direccion, :email, :idUbicacion)";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':nombre', $elNombre, PDO::PARAM_STR, 45 );
            $stmt->bindParam(':direccion', $elDireccion, PDO::PARAM_STR, 45);
            $stmt->bindParam(':email',   $elEmail,  PDO::PARAM_STR, 45);
            $stmt->bindParam(':idUbicacion', $elIdUbicacion, PDO::PARAM_INT);
            $stmt->execute();
            return true;

        }catch(PDOException $ex){
            cLog($ex->getMessage());
            return false;
        }
    }

    public function bajaEmpleado($empleado){ 

        $id = $empleado->getId();        
        try{
            $conn = db();
            $consulta = "UPDATE Empleado SET activo = 0 WHERE id = :id";
            $stmt = $conn->prepare($consulta);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR, 45 );            
            $stmt->execute();
        }catch(PDOException $ex){
            cLog($ex->getMessage());
            return false;
        }
    }

    public function getAllTiendasID(){
        try{
            $conn = db();
            $array = [];
            $consulta = "SELECT id FROM Tienda";
            $stmt = $conn->query($consulta);
            if (!$stmt) {
                cLog("Query failed: ".$mysqli->error);
                exit;
            }                    
            while( $fila = $stmt->fetch()){
                $array[] = $fila; 
            }
        }catch(PDOException $ex){
            cLog($ex->getMessage());            
        }            
            return $array;
    }

    public function getAllEmpleados(){
        try{
            $conn = db();
            $empleados = [];
            $consulta = "SELECT id, username FROM Empleado ORDER BY username";
            $stmt = $conn->query($consulta);
            if (!$stmt) {
                cLog("Query failed: ".$mysqli->error);
                exit;
            }                    
            while( $fila = $stmt->fetch(PDO::FETCH_ASSOC)){
                $empleados[] = [
                    'id' => $fila['id'],
                    'username' => $fila['username']
                ]; 
            }
        }catch(PDOException $ex){
            cLog($ex->getMessage());            
        }            
            return $empleados;
    }

}