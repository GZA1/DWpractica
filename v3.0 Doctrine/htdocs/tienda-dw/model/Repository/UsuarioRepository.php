<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class UsuarioRepository extends EntityRepository{
    
    public function login($usuario){
        $em  = getEntityManager();   
        $qb = $em->createQueryBuilder();
        $qb->select('u')
            ->from('Entity\\Usuario', 'u')
            ->where('u.username = :usr', 'u.passwd = :psw')
            ->setParameter('usr', $usuario->getIdUsuario())
            ->setParameter('psw', $usuario->getPasswd());

        // $DQL = "select u from Entity\\Usuario u where u.username = :usr and u.passwd = :psw";
        // $query = $em->createQuery($DQL);
        // $query->setParameters(array(
        //                                 'usr' => $usuario->getIdUsuario(),
        //                                 'psw' => $usuario->getPasswd()
        //                             ));      
        $ubic = $qb->getQuery()->getResult();  
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