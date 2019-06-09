<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class CategoriaRepository extends EntityRepository
{
    public function findProductosPrecioGT50()
    {
        $DQL = "select p from Entity\\Producto p where p.precio > 50";
        $query = $this->_em->createQuery($DQL);
        $productosGT50 = $query->getResult();  
        return $productosGT50;        
    }







    
}

?>