<?php 

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PedidoRepository extends EntityRepository
{
    
    public function tramitarPedido($pedido){
        if(isset($pedido)){
            $this->_em->persist($pedido);
            $this->_em->flush();
            return true;
        }
        return false;
    }



}

?>