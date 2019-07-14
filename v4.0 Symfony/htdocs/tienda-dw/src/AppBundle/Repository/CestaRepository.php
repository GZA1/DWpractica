<?php 

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';


class CestaRepository extends EntityRepository
{
    
    public function addUnidades($cesta, $unidades, $precio, $enviar){
        $udsCesta = $cesta->getUnidades();
        $lenCesta = sizeof($udsCesta);
        $lenUds = sizeof($unidades);
        if(!is_null($cesta)){

            for($i=0; $i<$lenUds; $i++){
                $udsCesta[$i+$lenCesta] = $unidades[$i];
            }
            $cesta->setUnidades($udsCesta);
            console_log((array)$cesta->getUnidades());

            $precioTotal = $precio * $lenUds;
            $cesta = $cesta->addCosteTotal($precioTotal);
            
            
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Cesta', 'c')
            ->set('c.costeTotal', ':cos')
            ->where('c.id = :cestaId')
            ->setParameter('cos', $cesta->getCosteTotal())
            ->setParameter('cestaId', $cesta);
            $res = $qb->getQuery()->getResult();
            
            console_log('Cesta');
            console_log((array)$cesta);

            
            
            foreach($unidades as $u){
                // $qb = $this->_em->createQueryBuilder();
                // $qb ->update('AppBundle\\Entity\\Unidad', 'u')
                // // ->set('u.cesta', ':c')
                // ->set('u.enviar', ':enviar')
                // ->where('u.id = :unidad')
                // // ->setParameter('c', $cesta)
                // ->setParameter('enviar', $enviar)
                // ->setParameter('unidad', $u);
                // $res = $qb->getQuery()->getResult();
                $u->setEnviar($enviar);
            }
            $this->_em->flush();
            
            
            console_log((array)$cesta->getUnidades());
            console_log($cesta->getCosteTotal());

        }

            return $cesta;
        }

    public function cancelarCesta($cesta){
        $udsCesta = $cesta->getUnidades();
        $lenCesta = sizeof($udsCesta);

        $qb = $this->_em->createQueryBuilder();
        foreach($udsCesta as $u){
            $qb ->update('AppBundle\\Entity\\Unidad', 'u')
            ->set('u.cesta', ':c')
            ->set('u.enviar', ':e')
            ->where('u.id = :unidad')
            ->setParameter('c', null)
            ->setParameter('e', null)
            ->setParameter('unidad', $u);
            $res = $qb->getQuery()->getResult();
        }
        $qb ->delete('AppBundle\\Entity\\Cesta', 'c')
            ->where('c.cesta = :cesta')
            ->setParameter('cesta', null);
            $res = $qb->getQuery()->getResult();
        return $cesta;
    }

    public function addCesta($newCesta, $cliente){
        $cliente->addCesta($newCesta);
        $qb = $this->_em->createQueryBuilder();
        $qb ->update('AppBundle\\Entity\\Cesta', 'c')
        ->set('c.cliente', ':cliente')
        ->where('c.id = :cesta')
        ->setParameter('cliente', $cliente)
        ->setParameter('cesta', $newCesta);
        $res = $qb->getQuery()->getResult();
        return $res;
    }

    public function generateId($cesta){
        
        $count = $this->_em->createQueryBuilder()  
                ->select('count(c.id)')
                ->from('AppBundle\\Entity\\Cesta', 'c')
                ->getQuery()
                ->getSingleScalarResult();
        console_log($count);
        if($count>0){
            $maxid = $this->_em->createQueryBuilder()
                        ->select('MAX(c.id)')
                        ->from('AppBundle\\Entity\\Cesta', 'c')
                        ->getQuery()
                        ->getSingleScalarResult();
            return $maxid + 1;
        }else{
            return 1;
        }
    
    }
}

?>