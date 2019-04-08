<?php
require_once("config.php");
require_once("console.php");

/** 
 * Obtiene todos los empleados 
 * 
 *  @return array 
 */
 
 function clientes_get_all()
 {
   $conn = db();

   $clientes = [];

   $consulta = "SELECT * FROM cliente";
   try{
      
      $stmt = $conn->query($consulta);

   }catch(PDOException $ex){
      echo "Hubo un error";
      console_log($ex->getMessage());
   }

   // if($stmt === false)

   // foreach($conn->query('SELECT * FROM cliente') as $row) {
   //     echo $row['id'].' '.$row['username'] .' '.$row['nombre'].' '.$row['apellidos'];
   // }

   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $clientes[] = [
         'id' => $row['id'],
         'username' => $row['username'],
         'passwd' => $row['passwd'],
         'nombre' => $row['nombre'],
         'apellidos' => $row['apellidos'],
         'email' => $row['email'],
         'domicilio' => $row['domicilio'],
         'monedero' => $row['monedero'],
         'fechaCreacion' => $row['fechaCreacion'],
         'fechaModificacion' => $row['fechaModificacion'],
         'Cesta_id' => $row['Cesta_id'] 
      ];
   }
   return $clientes;

 }


?>