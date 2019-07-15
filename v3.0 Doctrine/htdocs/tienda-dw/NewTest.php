<?php
    require_once 'dbconfig.php';

    use Entities\Tienda;
    use Entities\Categoria;
    use Entities\Producto;
    use Entities\Ubicacion;
    use Entities\Cliente;

    $em = GetEntityManager();



    
    //$ubicaciones = $em->getRepository("Entities\\Ubicacion")->findAll();
    $productos = $em->getRepository("Entity\\Producto")->findAll();
    // $clientes = $em->getRepository("Entities\\Cliente")->findAll();

    $categorias = $em->getRepository("Entity\\Categoria")->findAll();
    echo "hola1";
    
    $var = $em->getRepository("Entitiy\\Cliente")->doIDexist("CLI:000000004029530e0000000014d11trs");
    echo('console.log(' . json_encode($var) . ');');

    try{

        $DQL = "select c from Entity\\Cliente c where c.username = 'cli1'";
        $query = $em->createQuery($DQL);
        $clienteEspecial = $query->getResult();
    }catch(Exception $e){echo $e;}

    
?>
<html>

<body>
    <table>
    
        <tr>
            <td>Id</td>
            <td>Nombre</td>
        </tr>
        <?php foreach($categorias as $c) : ?>
        <tr>
            <td><?php echo $c->getId(); ?></td>
            <td><?php echo $c->getNombre(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <table>
        <tr>
            <td>Id</td>
            <td>Username</td>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Email</td>
            <td>Domicilio</td>
        </tr>
        <?php foreach($clientes as $c) : ?>
        <tr>
            <td><?php echo $c->getId(); ?></td>
            <td><?php echo $c->getUsername(); ?></td>
            <td><?php echo $c->getNombre(); ?></td>
            <td><?php echo $c->getApellidos(); ?></td>
            <td><?php echo $c->getEmail(); ?></td>
            <td><?php echo $c->getDomicilio(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <table>
        <tr>
            <td>Id</td>
            <td>Username</td>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Email</td>
            <td>Domicilio</td>
        </tr>
        <?php foreach($clienteEspecial as $c) : ?>
        <tr>
            <td><?php echo $c->getId(); ?></td>
            <td><?php echo $c->getUsername(); ?></td>
            <td><?php echo $c->getNombre(); ?></td>
            <td><?php echo $c->getApellidos(); ?></td>
            <td><?php echo $c->getEmail(); ?></td>
            <td><?php echo $c->getDomicilio(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>



    <table>
        <tr>
            <td>Id</td>
            <td>cp</td>
            <td>Municipio</td>
            <td>Provincia</td>
            <td>Comunidad Autonoma</td>
            <td>latitud</td>
            <td>longitud</td>
        </tr>
        <?php foreach($ubicaciones as $u) : ?>
        <tr>
            <td><?php echo $u->getCp(); ?></td>
            <td><?php echo $u->getMunicipio(); ?></td>
            <td><?php echo $u->getProvincia(); ?></td>
            <td><?php echo $u->getComunidadAutonoma(); ?></td>
            <td><?php echo $u->getLatitud(); ?></td>
            <td><?php echo $u->getLongitud(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <table>
        <tr>
            <td>Id</td>
            <td>nombre</td>
            <td>marca</td>
            <td>modelo</td>
            <td>precio</td>
          
        </tr>
        <?php foreach($productos as $u) : ?>
        <tr>
            <td><?php echo $u->getId(); ?></td>
            <td><?php echo $u->getNombre(); ?></td>
            <td><?php echo $u->getMarca(); ?></td>
            <td><?php echo $u->getModelo(); ?></td>
            <td><?php echo $u->getPrecio(); ?></td>
            
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
