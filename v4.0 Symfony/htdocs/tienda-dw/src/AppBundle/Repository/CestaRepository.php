<?php 

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Cesta;

require_once '/xampp/appdata/model/console.php';


class CestaRepository extends EntityRepository
{
    

    public function nuevaCesta($cesta){
        
        if(isset($cesta)){
            $this->_em->persist($cesta);
            $this->_em->flush();
            return true;
        }
        return false;
    }



    public function cancelarCesta($cesta){
        if(isset($cesta)){

            if($cesta->getUnidades() != null){
                
                foreach($cesta->getUnidades() as $unit){
                    $unit = $unit->setCesta(null);
                    $unit = $unit->setEnviar(null);
                    $this->_em->merge($unit);
                    $this->_em->flush();  
                }
            }
            $qb = $this->_em->createQueryBuilder();
            $qb ->delete('AppBundle\\Entity\\Cesta', 'c')
                ->where('c.id = :cesta')
                ->setParameter('cesta', $cesta->getId());
            $qb->getQuery()->getResult();
            return true;
        }
        return false;
        
    }

}

?>