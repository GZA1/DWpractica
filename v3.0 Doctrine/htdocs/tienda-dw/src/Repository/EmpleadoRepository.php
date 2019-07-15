<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class EmpleadoRepository extends EntityRepository
{
    public function findProductosPrecioGT50()
    {
        $DQL = "select p from Entities\\Producto p where p.precio > 50";
        $query = $this->$em->createQuery($DQL);
        $productosGT50 = $query->getResult();  
        return $productosGT50;        
    }
    
    public function getEmpleadoByID($username, $passwd, $nombre, $apell, $email, $photoPath, $active, $cargo, $isAdministrador, $tienda_id){
        
        $DQL = "select * from Entities\\Empleado where id = :id";
        $query = -> $this->createQuery($DQL);
        $query->setParameters('id', $id);
        $emp = $query->$em->getResult();
    }

    /* No se si funciona, probar*/
    public function updatePerfilEmpleado($id, $username, $name, $surnames){
        if(isset($username), isset($name), isset($surnames)){
        $DQL = "update Entities\\Empleado set  username = :Username, nombre = :Nombre, apellidos = :Apellidos where id = :id";
        $query = $this->$em->createQuery($DQL);
        $query->setParameters(  array(
                                'id' => $id,
                                'Username'=> $username,
                                'Nombre' => $nombre,
                                'Apellidos' => $surnames                           
                            ));           
            return true;
        }else{
            return false;
        }
    }

    public function doIDexist($id){
        $DQL = "select count(*) from Entities\\Empleado where id = :ID";
        $query = $this->$em->createQuery($DQL);
        $query->setParameters('ID' => $id);
        $resultado = $query->getResult();
        if($resultado > 0){
            return true;
        }else{
            return false;
        }
    }



}

?>
