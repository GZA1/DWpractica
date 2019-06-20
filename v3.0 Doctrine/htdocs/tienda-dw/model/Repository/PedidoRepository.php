<?php 

namespace Repository;

use Entity\Cesta;

use Doctrine\ORM\EntityRepository;

require_once('/xampp/appdata/model/console.php');

class PedidoRepository extends EntityRepository
{
    
    public function findPedidosByUser($usuario){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('p')
            ->from('Entity\\Pedido','p')
            ->join('p.cesta', 'ce')
            ->join('ce.cliente', 'cl')
            ->where('cl.usuario = :u')
            ->setParameter(':u', $usuario);
        $res = $qb->getQuery()->getResult();
        console_log((array)$res);
        return $res;
    }



}

?>