<?php
    require_once 'dbconfig.php';

    use Entitiy\Categoria;
    use Entity\Producto;
    use Entity\Ubicacion;
    use Entity\Cliente;
    
    $em = GetEntityManager();

    
    $clientes = $em->getRepository("Entities\\Cliente")->findAll();
    echo "hola";
    
    $ubicaciones = $em->getRepository("Entities\\Ubicacion")->findAll();
    
    /* Caso 1. Obtener collecion objetos */
    /* select * from catalogo_categorias */
    $categorias = $em->getRepository("Entities\\Categoria")->findAll(); 

    /* Caso 2. Obtener un objeto concreto por su Id */
    /* select * from catalogo_categorias where id = 'NNN' */
    $categoriaRAM = $em->getRepository("Entities\\Categoria")->find(2);  
    /* Caso 3. Obtener collecion objetos en base a una condicion */
    /* select * from catalogo_productos where precio = 'NNN */
    //$productos = $em->getRepository("Entities\\Producto")->findBy(['precio'=>40.5]);    
    
    /* Caso 4. Obtener un unico objeto en base a una condicion */
    /* select * from catalogo_productos where precio = 'NNN */
    //$producto = $em->getRepository("Entities\\Producto")->findOneBy(['precio'=>90.5]);    
    
    /* Caso 5. Obtener una coleccion de objetos usando DQL */ 

    //$DQL = "select p from Entities\\Producto p where p.precio > 50";
    //$query = $em->createQuery($DQL);
   // $productosGT50 = $query->getResult();

    // o esta manera
    // $productosGT50 = $em->getRepository("Entities\\Producto")->findProductosPrecioGT50()

    /* Caso 6. Obtener objetos a traves de una relacion */
    /* select * from catalogo_productos where catalogo_categorias_id = 'NNN */
    $productosRAM = $categoriaRAM->getProductos();     


    $var = $em->getRepository("Entitiy\\Cliente")->doIDexist("CLI:000000004029530e0000000014d11trs");
    echo('console.log(' . json_encode($var) . ');');
?>
<html>

<body>
<h3 style="color: red">
<?php
    if( $_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['errnotfound']) && $_GET['errnotfound']==1 ) {
        echo("No se encontró el código postal indicado");
    }
?>
</h3>
<form method="post" id="formTest">
    <label>Código Postal</label>
    <input type="number" id="cp" name="cp">
</form>
<?php
    if( $_SERVER['REQUEST_METHOD']=='POST') {
        try{
            $ubicaciones = $em->getRepository("Entity\\Ubicacion")->findUbicacionesPorCp($_POST['cp']);
            console_log($ubicaciones);
            if( empty($ubicaciones) ){
                header("Location: " . $_SERVER['PHP_SELF'] . "?errnotfound=1");
            }
        } catch(Exception $e){echo $e;}
?>
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
<?php
    }
?>
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
    <!-- <table>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Precio</td>
        </tr>
        <?php //foreach($productosGT50 as $p) : ?>
        <tr>
            <td><?php //echo $p->getId(); ?></td>
            <td><?php //echo $p->getNombre(); ?></td>
            <td><?php //echo $p->getPrecio(); ?></td>
        </tr>
        <?php //endforeach; ?>
    </table> -->
    <!-- <p>
        Producto de precio 90.5:<br />
        Id: <?php //echo $producto->getId() ?><br>
        Nombre: <?php //echo $producto->getNombre() ?><br>
        Precio: <?php //echo $producto->getPrecio() ?><br>
        Fecha Creacion: <?php //echo $producto->getFechaCreacion()->format('d/m/Y H:i:s') ?><br>
        Fecha Modificacion: <?php //echo $producto->getFechaModificacion()->format('d/m/Y H:i:s') ?>
    </p>
    <table>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Precio</td>
        </tr>
        <?php //foreach($productosRAM as $p) : ?>
        <tr>
            <td><?php //echo $p->getId(); ?></td>
            <td><?php //echo $p->getNombre(); ?></td>
            <td><?php //echo $p->getPrecio(); ?></td>
        </tr>
        <?php //endforeach; ?>
    </table> -->
</body>

</html>