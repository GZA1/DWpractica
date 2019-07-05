<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class TiendaRepository extends EntityRepository
{

    public function findAll(){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('t')
            ->from('Entity\\Tienda', 't');
        $res = $qb->getQuery()->getResult();
        console_log((array)$res[0]->getNombre());
        return $res;   
    }

    public function exists($t){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('count(t.id)')
            ->from('Entity\\Tienda', 't')
            ->where('t.email = :email')
            ->setParameter('email', $t->getEmail());
        $res = $qb->getQuery()->getSingleScalarResult();
        if( $res == 0 ){
            return false;
        } else{
            return true;
        }
    }

    public function registrarTienda($t){
        if( isset($t) && ! $this->exists($t) ){
            $this->_em->persist($t);
            $this->_em->flush();
            return true;
        }
        return false;
    }
    
    public function addTienda($tienda){
        try{
            $this->_em->persist($tienda);
            $this->_em->flush();
            return true;
        }catch(Exception $ex){
            return false;
        };
    }
}

?>