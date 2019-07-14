<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class ClienteRepository extends EntityRepository
{

    public function findByUser($usuario){
        return $this->findOneBy(["usuario" => $usuario]);
    }

    public function updatePerfilCliente($u, $username, $nombre, $apellidos, $domicilio){
        if(isset($u) && isset($username) && isset($nombre) && isset($apellidos) && isset($domicilio) ){
            $c = $this->findByUser($u);
            $u  ->setUsername($username)
                ->setNombre($nombre)
                ->setApellidos($apellidos)
            ;
            $c->setDomicilio($domicilio);
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Usuario', 'u')
                ->set('u.username', ':username')
                ->set('u.nombre', ':nombre')
                ->set('u.apellidos', ':apell')
                ->where('u.idUsuario = :u')
                ->setParameter('username', $username)
                ->setParameter('nombre', $nombre)
                ->setParameter('apell', $apellidos)
                ->setParameter('u', $u);
            $res = $qb->getQuery()->getResult();
            console_log($res);
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Cliente', 'c')
                ->set('c.domicilio', ':domic')
                ->where('c.usuario = :u')
                ->setParameter('domic', $domicilio)
                ->setParameter('u', $u);
            $res = $qb->getQuery()->getResult();
            console_log($res);
            return true;
        } else{
            return false;
        }
    }

    public function updateSaldo($c){
        if(isset($c)){
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Cliente', 'c')
                ->set('c.saldo', ':saldo')
                ->where('c.id = :c')
                ->setParameter('saldo', $c->getSaldo())
                ->setParameter('c', $c);
            $res = $qb->getQuery()->getResult();
            return true;
        }
        return false;
    }


    
    public function doIDexist($id){
        $resultado = $this->findBy(['id'=>$id]);
        if(sizeof($resultado) > 0){
            return true;

        }else{
            return false;
        }
        
    }



public function get_all()
{
    $resultado = $this->findAll();
    return $resultado;
}


private function getDataClienteId($id){

    $resultado = $this->findOneBy(['id'=>$id]);

    return $resultado;
}




}

?>