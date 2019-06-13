<?php



    require_once 'dbconfig.php';
    require_once '/xampp/appdata/model/console.php';

    use Entity\Tienda;
    use Entity\Categoria;
    use Entity\Producto;
    use Entity\Ubicacion;
    use Entity\Cliente;

    $em = GetEntityManager();



    $var = $em->getRepository("Entity\\Cliente")->doIDexist("CLI:000000004029530e0000000014d11trs");
    
    console_log('¿CLI:000000004029530e0000000014d11trs es Cliente?: ' . json_encode($var));

?>