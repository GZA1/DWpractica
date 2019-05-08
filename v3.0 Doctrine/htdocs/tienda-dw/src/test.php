<?php
    require_once 'dbconfig.php';

    use Entities\Categoria;

    $em = GetEntityManager();

    
    /* Caso 1. Obtener collecion objetos */
    /* select * from catalogo_categorias */
    $categorias = $em->getRepository("Entities\\Categoria")->findAll(); 

    /* Caso 2. Obtener un objeto concreto por su Id */
    /* select * from catalogo_categorias where id = 'NNN' */
    $categoriaRAM = $em->getRepository("Entities\\Categoria")->find(2);  
    
    /* Caso 3. Obtener collecion objetos en base a una condicion */
    /* select * from catalogo_productos where precio = 'NNN */
    $productos = $em->getRepository("Entities\\Producto")->findBy(['precio'=>40.5]);    
    
    /* Caso 4. Obtener un unico objeto en base a una condicion */
    /* select * from catalogo_productos where precio = 'NNN */
    $producto = $em->getRepository("Entities\\Producto")->findOneBy(['precio'=>90.5]);    
    
    /* Caso 5. Obtener una coleccion de objetos usando DQL */ 

    $DQL = "select p from Entities\\Producto p where p.precio > 50";
    $query = $em->createQuery($DQL);
    $productosGT50 = $query->getResult();

    // o esta manera
    // $productosGT50 = $em->getRepository("Entities\\Producto")->findProductosPrecioGT50()

    /* Caso 6. Obtener objetos a traves de una relacion */
    /* select * from catalogo_productos where catalogo_categorias_id = 'NNN */
    $productosRAM = $categoriaRAM->getProductos();     
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
    <p>
        Categoria de memorias RAM:<br />
        Id: <?php echo $categoriaRAM->getId() ?><br>
        Nombre: <?php echo $categoriaRAM->getNombre() ?><br>
        Fecha Creacion: <?php echo $categoriaRAM->getFechaCreacion()->format('d/m/Y H:i:s') ?><br>
        Fecha Modificacion: <?php echo $categoriaRAM->getFechaModificacion()->format('d/m/Y H:i:s') ?>
    </p>
    <table>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Precio</td>
        </tr>
        <?php foreach($productos as $p) : ?>
        <tr>
            <td><?php echo $p->getId(); ?></td>
            <td><?php echo $p->getNombre(); ?></td>
            <td><?php echo $p->getPrecio(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <table>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Precio</td>
        </tr>
        <?php foreach($productosGT50 as $p) : ?>
        <tr>
            <td><?php echo $p->getId(); ?></td>
            <td><?php echo $p->getNombre(); ?></td>
            <td><?php echo $p->getPrecio(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p>
        Producto de precio 90.5:<br />
        Id: <?php echo $producto->getId() ?><br>
        Nombre: <?php echo $producto->getNombre() ?><br>
        Precio: <?php echo $producto->getPrecio() ?><br>
        Fecha Creacion: <?php echo $producto->getFechaCreacion()->format('d/m/Y H:i:s') ?><br>
        Fecha Modificacion: <?php echo $producto->getFechaModificacion()->format('d/m/Y H:i:s') ?>
    </p>
    <table>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Precio</td>
        </tr>
        <?php foreach($productosRAM as $p) : ?>
        <tr>
            <td><?php echo $p->getId(); ?></td>
            <td><?php echo $p->getNombre(); ?></td>
            <td><?php echo $p->getPrecio(); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>