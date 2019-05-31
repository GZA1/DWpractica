<?php
    require_once("dbconfig.php");
    require_once('/xampp/appdata/model/console.php');

    use Entity\Ubicacion;

    $em = GetEntityManager();

    echo "hola";
?>

<html>
<body>
<h3 style="color: red">
<?php
    if( $_SERVER['REQUEST_METHOD']=='GET' && $_GET['errnotfound']==1 ) {
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
</body>
</html>