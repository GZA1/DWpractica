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
            $u->setEnviar($enviar);
        }

        console_log((array)$cesta->getUnidades());
        console_log($cesta->getCosteTotal());


        return $cesta;
    }

}

?>