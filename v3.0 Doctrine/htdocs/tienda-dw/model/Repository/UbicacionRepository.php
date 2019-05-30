<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class UbicacionRepository extends EntityRepository{

    public function findUbicacionesPorCp($cp){
        $DQL = "select u from Entity\\Ubicacion u where u.cp = ".$cp;
        $query = $this->_em->createQuery($DQL);
        $ubic = $query->getResult();  
        return $ubic;   
    }
    
}