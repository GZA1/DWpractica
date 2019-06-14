<?php 

namespace Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class UsuarioRepository extends EntityRepository{
    
    public function login($usuario){
        $em  = getEntityManager();
        $qb = $em->createQueryBuilder();
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
        $res = $qb->getQuery()->getSingleResult();
        return $res;
    }

    //POsiblemente la vamos a eliminar
    public function findId($usuario){
        $em  = getEntityManager();
        $qb = $em->createQueryBuilder();
        if( ! is_null($usuario->getIdUsuario()) ){
            $qb ->select('u.id')
                ->where('u.Usuario_idUsuario = :idUsr')
                ->setParameter('idUsr', $usuario->getIdUsuario());
            $tipo = $usuario->getTipo();
            if($tipo == "cliente"){
                $qb->from('Entity\\Cliente', 'u');
            }else if($tipo == "empleado"){
                $qb->from('Entity\\Empleado', 'u');
            }
        } else{
            $this->finId($usuario->setIdUsuario($this->login($usuario)));//:D   -·__·-
        }
        $res = $qb->getQuery()->getSingleResult();
        return $res;
    }
}

?>