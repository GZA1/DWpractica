<?php 

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PedidoRepository extends EntityRepository
{

    public function tramitarPedido($pedido){
        if(isset($pedido)){
            $unidades = $pedido->getCesta()->getUnidades();
            $cliente = $pedido->getCesta()->getCliente();
            $saldo = $cliente->getSaldo();
            $costeTotal = $pedido->getCesta()->getCosteTotal();
            if($saldo < $costeTotal){
                return false;
            }else{
                $cliente->setSaldo($saldo - $costeTotal);
            }
            foreach($unidades as $u){
                $u->setVendido(true);
            }
            $this->_em->persist($cliente);
            $this->_em->persist($u);
            $this->_em->persist($pedido);
            $this->_em->flush();
            return true;
        }
        return false;
    }



}

?>
