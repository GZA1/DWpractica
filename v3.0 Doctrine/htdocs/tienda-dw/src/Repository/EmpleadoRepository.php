<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class EmpleadoRepository extends EntityRepository
{
    public function findProductosPrecioGT50()
    {
        $DQL = "select p from Entity\\Producto p where p.precio > 50";
        $query = $this->_em->createQuery($DQL);
        $productosGT50 = $query->getResult();  
        return $productosGT50;        
    }
    
    public function getEmpleadoByID($username, $passwd, $nombre, $apell, $email, $photoPath, $active, $cargo, $isAdministrador, $tienda_id){
        
        $DQL = "select * from Entity\\Empleado where id = :id";
        $query = -> $this ->createQuery($DQL);
        $query->setParameters('id' => 'Bob');
        $emp = $query->_em->getResult();
    }


}

?>
