<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository{
    public function login($usuario){
        $DQL = "select u from Entity\\Ubicacion u where u.cp = ".$cp;
        $query = $this->_em->createQuery($DQL);
        $ubic = $query->getResult();  
        return $ubic;   
    }

    public function findId($usuario){
        $DQL = "select u from Entity\\Ubicacion u where u.cp = ".$cp;
        $query = $this->_em->createQuery($DQL);
        $ubic = $query->getResult();  
        return $ubic;   
    }
}

?>