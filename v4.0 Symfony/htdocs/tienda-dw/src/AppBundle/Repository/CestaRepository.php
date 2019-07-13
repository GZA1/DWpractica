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
        for($i=0; $i<$lenUds; $i++){
            $udsCesta[$i+$lenCesta] = $unidades[$i];
        }
        $cesta->setUnidades($udsCesta);
        console_log((array)$cesta->getUnidades());

        $cesta->addCosteTotal($precio * $lenUds);

        foreach($unidades as $u){
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Unidad', 'u')
            ->set('u.cesta', ':c')
            ->set('u.enviar', ':enviar')
            ->where('u.id = :unidad')
            ->setParameter('c', $cesta)
            ->setParameter('enviar', $enviar)
            ->setParameter('unidad', $u);
            $res = $qb->getQuery()->getResult();
        }
        
        $u->setEnviar($enviar);

        console_log((array)$cesta->getUnidades());
        console_log($cesta->getCosteTotal());


        return $cesta;
    }

    public function cancelarCesta($cesta){
        $udsCesta = $cesta->getUnidades();
        $lenCesta = sizeof($udsCesta);

        foreach($udsCesta as $u){
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Unidad', 'u')
            ->set('u.cesta', ':c')
            ->set('u.enviar', ':e')
            ->where('u.id = :unidad')
            ->setParameter('c', null)
            ->setParameter('e', null)
            ->setParameter('unidad', $u);
            $res = $qb->getQuery()->getResult();
        }
        return $cesta;
    }

}

?>