<?php
    require_once('/xampp/appdata/model/console.php');
    require_once('/xampp/appdata/model/Usuario.php');

    session_start();

    $c = null;
   
    if(isset($_SESSION['id'])){
        $c = new Cliente($_SESSION['id']);
        $tipo = $c->getTipo();
        $username = $c->getUsername();
        $listaPedidos = $c->getPedidos();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
        <meta name="keywords" content="hardware components">
        <meta name="robots" content="NoIndex, NoFollow">
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="/dw/img/logo.png" type="image/png">
        <link rel="stylesheet" href="../styles/style-shared.css">
        <link rel="stylesheet" href="../styles/style-pedidos.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <title>Historial Pedidos de <?php echo($username) ?></title>
    </head>
    <body>
        <div class="flex_cols" id="contenedor-inic">
            <div style="height: 10vh; min-height: 200px; visibility: hidden"></div>
            <div id="logo-inic">
                <a href="../main/index.php">
                    <img src="../img/logo_horizontal.png" width="100%">
                </a>
            </div>
            <div style="height: 10vh; min-height: 150px; visibility: hidden"></div>
            <div>Pedidos del cliente <?php echo($username) ?></div>
            <ol>
        <?php 
            foreach($listaPedidos as $p) { 
        ?>
            <div class="flex_rows">
            <?php
                foreach($p as $key => $value) {
            ?>
                <div><?php echo($key . "=>" . $value . " | "); ?></div>
            <?php
                }
            ?>
            </div>
        <?php
            }
        ?>
        </div>
    </body>
        <?php require_once("../footer/footer.php"); ?>
</html>
<?php
    }else{
        header("Location: ../main");
    }
?>