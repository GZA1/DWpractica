<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class UbicacionRepository extends EntityRepository{

    public function findUbicacionesPorCp($cp){
        $DQL = "select u from Entity\\Ubicacion u where u.cp = ".$cp;
        $query = $this->_em->createQuery($DQL);
        $ubic = $query->getResult();  
        return $ubic;   
    }

    public function findByMunic($municipio){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('u')
            ->from('Entity\\Ubicacion', 'u')
            ->where('u.municipio = :mun')
            ->setParameter('mun', $municipio);
        $res = $qb->getQuery()->getResult();
        return $res[0];
    }
    
}