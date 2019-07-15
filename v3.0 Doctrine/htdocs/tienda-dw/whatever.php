<?php



    require_once 'dbconfig.php';

    use Entity\Tienda;
    use Entity\Categoria;
    use Entity\Producto;
    use Entity\Ubicacion;
    use Entity\Cliente;

    $em = GetEntityManager();



    $var = $em->getRepository("Entity\\Cliente")->doIDexist("CLI:000000004029530e0000000014d11trs");
    
    //echo('console.log(' . json_encode($var) . ');');

?>