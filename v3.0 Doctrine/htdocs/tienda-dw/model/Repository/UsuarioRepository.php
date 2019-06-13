<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository{
    public function login($usuario){
        $DQL = "select u from Entity\\Ubicacion u".
                "where u.username = ".$usuario->getUsername().
                "and u.passwd = ".$usuario->getPasswd();
        $query = $this->$em->createQuery($DQL);
        $ubic = $query->getResult();  
        return $ubic;   
    }

    public function findId($usuario){
        if( ! is_null($usuario->getUsername()) ){
            $DQL = "select id from Entity\\Usuario u where u.username = ".$usuario->getUsername();
        } else if( ! is_null($usuario->getUsername()) ){
            $DQL = "select id from Entity\\Usuario u where u.email = ".$usuario->getEmail();
        } else{
            return false;
        }
        $query = $this->$em->createQuery($DQL);
        $id = $query->getResult();
        return $id;   
    }
}

?>