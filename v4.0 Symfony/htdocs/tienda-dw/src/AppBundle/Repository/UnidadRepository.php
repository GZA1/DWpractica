<?php 

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class UnidadRepository extends EntityRepository
{

    public function findUnidades($tienda, $producto, $cantidad){

        $uds = $this->findBy([  'tienda'     => $tienda,
                                'producto'   => $producto,
                                'vendido'    => 0,
                                'cesta'    => null
                                ]);

        console_log($uds);

        $res = array();

        if(sizeof($uds) >= $cantidad){

            for($i=0; $i<$cantidad; $i++){
                $res[$i]=$uds[$i];
            }

            console_log($res);


            return $res;

        }else{
            return false;
        }
    }


    public function añadirACesta($unidades, $cesta, $enviar, $precio){  
        if(isset($unidades) && isset($cesta) && isset($enviar)){

            $costeTotal = $cesta->getCosteTotal();
            $len = sizeof($unidades);
            $cesta->addCosteTotal($len * $precio);

            foreach($unidades as $unit){
                $unit = $unit->setCesta($cesta);
                $unit = $unit->setEnviar($enviar);
                $this->_em->persist($unit);
            }        
            $this->_em->persist($cesta);
            $this->_em->flush();
            return true;
        }
        return false;
    }
    
}

?>