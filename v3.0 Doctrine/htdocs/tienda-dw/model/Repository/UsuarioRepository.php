<?php 

namespace Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class UsuarioRepository extends EntityRepository{
    
    public function login($usuario){
        $qb = $this->_em->createQueryBuilder();
        if( ! is_null($usuario->getUsername()) ){
            $qb ->select('u')
                ->from('Entity\\Usuario', 'u')
                ->where('u.username = :usr', 'u.passwd = :psw')
                ->setParameter('usr', $usuario->getUsername())
                ->setParameter('psw', $usuario->getPasswd());
            console_log($usuario->getUsername());
        } else if( ! is_null($usuario->getEmail()) ){
            $qb ->select('u')
                ->from('Entity\\Usuario', 'u')
                ->where('u.email = :email', 'u.passwd = :psw')
                ->setParameter('email', $usuario->getEmail())
                ->setParameter('psw', $usuario->getPasswd());
            console_log($usuario->getEmail());
        } else{
            return false;
        }
        console_log($usuario->getPasswd());
        echo $qb;
        echo  $usuario->getEmail();
        echo  $usuario->getUsername();
        echo  $usuario->getPasswd();
        $res = $qb->getQuery()->getOneOrNullResult();
        return $res;
    }

    
    public function findByUsername($username){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('u')
            ->from('Entity\\Usuario', 'u')
            ->where('u.username = :usr')
            ->setParameter('usr', $username);
        $res = $qb->getQuery()->getSingleResult();
        return $res;
    }


    public function existsUsername($username){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('count(u.idUsuario)')
            ->from('Entity\\Usuario', 'u')
            ->where('u.username = :usr')
            ->setParameter('usr', $username);
        $res = $qb->getQuery()->getSingleScalarResult();
        if( $res == 0 ){
            return false;
        } else{
            return true;
        }
    }

    public function existsEmail($email){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('count(u.idUsuario)')
            ->from('Entity\\Usuario', 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email);
        $res = $qb->getQuery()->getSingleScalarResult();
        if( $res == 0 ){
            return false;
        } else{
            return true;
        }
    }

    public function changePasswd($usuario, $newPasswd){
        if(isset($usuario) && isset($newPasswd) ){
            $usuario->setPasswd($newPasswd);
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('Entity\\Usuario', 'u')
                ->set('u.passwd', ':passwd')
                ->where('u.idUsuario = :usr')
                ->setParameter('passwd', $newPasswd)
                ->setParameter('usr', $usuario);
            $res = $qb->getQuery()->getResult();
            return $res;
        } else{
            return false;
        }
    }
    public function compararPass($usuario, $pass){
        if( isset($usuario) && isset($pass)){
            if($usuario->getPasswd() == $pass)
                return true;
        }else{
            
            return false;
        }
    }

    public function registrarUsuario($u){
        if(isset($u)){
            $this->_em->persist($u);
            $this->_em->flush();
            return true;
        }
        return false;
    }
    public function exists($usuario){
        return  $this->existsEmail($usuario->getEmail()) ||
                $this->existsUsername($usuario->getUsername());
    }

    public function findEmpleados(){
        return $this->findBy(['tipo' => 'empleado']);
    }

    public function findClientes(){
        return $this->findBy(['tipo' => 'cliente']);
    }

}

?>