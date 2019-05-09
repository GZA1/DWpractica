<?php
    require_once 'dbconfig.php';

    use Entities\Categoria;
    use Entities\Producto;
    use Entities\Ubicacion;
    use Entities\Cliente;

    $em = GetEntityManager();



    
    $clientes = $em->getRepository("Entities\\Cliente")->findAll();
    $ubicaciones = $em->getRepository("Entities\\Ubicacion")->findAll();
    $categorias = $em->getRepository("Entities\\Categoria")->findAll();
    
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
</body>

</html>
