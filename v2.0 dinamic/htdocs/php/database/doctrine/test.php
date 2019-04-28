<?php
    require_once 'dbconfig.php';

    use Entity\Categoria;

    $em = GetEntityManager();

    /* Caso 1. Obtener collecion objetos */
    /* select * from catalogo_categorias */
    $categorias = $em->getRepository("Entity\\Categoria")->findAll(); 
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
</body>
</html>