<?php 

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class UnidadRepository extends EntityRepository
{

    public function findUnidades($tienda, $producto, $cantidad){

        $uds = $this->findBy([  'tienda'     => $tienda,
                                'producto'   => $producto,
                                'vendido'    => 0
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
    
}

?>