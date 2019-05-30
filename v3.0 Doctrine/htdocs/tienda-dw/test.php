<?php
    require_once("dbconfig.php");

    use Entity\Ubicacion;

    $em = GetEntityManager();


    $clientes = $em->getRepository("Entities\\Cliente")->findAll();
    echo "hola";

    $ubicaciones = $em->getRepository("Entities\\Ubicacion")->findAll();

    /* Caso 1. Obtener collecion objetos */
    /* select * from catalogo_categorias */
    $ubicaciones = $em->getRepository("Entity\\Ubicacion")->findAll();
?>

<html>
<body>
<table>
    <tr>
        <td>IdUbicacion</td>
        <td>CP</td>
        <td>Municipio</td>
        <td>Provincia</td>
        <td>Comunidad Autónoma</td>
        <td>Latitud</td>
        <td>Longitud</td>
    </tr>
    <?php foreach($ubicaciones as $u) : ?>
    <tr>
        <td><?php echo $u->getIdUbicacion(); ?></td>
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
