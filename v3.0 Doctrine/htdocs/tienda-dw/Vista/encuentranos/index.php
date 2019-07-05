<?php
    require_once('/xampp/appdata/model/Console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    

    session_start();

    $c = null;
    if(isset($_SESSION['user'])){
        $u = new Usuario($_SESSION['user']);
        $tipo = $u->getTipo();
        $username = $u->getUsername();
    }
    if( $_SERVER['REQUEST_METHOD']=='GET') {
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
        <meta name="keywords" content="hardware components">
        <meta name="robots" content="NoIndex, NoFollow">
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="/dw/img/logo.png" type="image/png">
        <link rel="stylesheet" href="../styles/style-shared.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Encuéntranos</title>
    </head>
    <body>
        <?php require_once('../nav/nav.php'); ?>
        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
        <div class="flex_cols">
            <div class="flex_rows" id="contenedor_main_ads">
    <!--        Este div contiene la parte central -->
                <div class="mainContainer altura_body_main_container">
                    <div id="contenidoMain" class="mapa_central">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2982.3770409752533!2d-4.717704684502627!3d41.62598097924306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4712d844c78375%3A0x8532df1684bc7224!2sUniversidad+Europea+Miguel+de+Cervantes+-+UEMC!5e0!3m2!1ses!2ses!4v1547635284329" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>
        <!--        Este div contiene los anuncios -->
                <aside class="adsLateral adDerecha">
                    <ul class="lista_ads">
                        <li class="ad_container">
                            <a href="http://www.uemc.es/" target="_blank" class="ad_enlace">
                                <div><b>ANUNCIO</b></div>
                                <div><img alt="UEMC" width="100%"  src="../img/ad1.png"></div>
                            </a>
                        </li>
                        <li class="ad_container">
                            <a href="http://www.uemc.es/" target="_blank" class="ad_enlace">
                                <div><b>ANUNCIO</b></div>
                                <div><img alt="UEMC" width="100%" src="../img/ad2.png"></div>
                            </a>
                        </li>
                        <li class="ad_container">
                            <a href="http://www.uemc.es/" target="_blank" class="ad_enlace">
                                <div><b>ANUNCIO</b></div>
                                <div><img alt="UEMC" width="100%" src="../img/ad3.png"></div>
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
    </body>
    <?php require_once("../footer/footer.php"); ?>
</html>
    <?php
        if( isset($_GET['usrlog']) ){
            if($_GET['usrlog']==1){
    ?>
    <script>
        $('head').before('<div id="usrlog" style="width: 100%; height: 20px; color: #56ed2d; background-color: #1e1e15; padding: 10px;">Logueado con éxito</div>');
        setTimeout(function(){
            $('#usrlog').fadeOut('fast');
            }, 4000
            );
    </script>
    <?php
            }else if($_GET['usrlog']==0){
    ?>
    <script>
        $('head').before('<div id="usrlog" style="width: 100%; height: 20px; color: #0073e6; background-color: #1e1e15; padding: 10px;">Sesión cerrada</div>');
        setTimeout(function(){
            $('#usrlog').fadeOut('fast');
            }, 4000
            );
    </script>
<?php
            }
        }else if( isset($_GET['saldoadd'])){
            if($_GET['saldoadd']==1){
?>
        <script>
            $('head').before('<div id="saldoadd" style="width: 100%; height: 20px; color: #ffb246; background-color: #1e1e15; padding: 10px;">Saldo añadido con éxito</div>');
            setTimeout(function(){
                $('#saldoadd').fadeOut('fast');
                }, 4000
                );
        </script>
<?php
            }
            else if($_GET['saldoadd']==0){
?>
        <script>
            $('head').before('<div id="saldoadd" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #1e1e15; padding: 10px;">No se pudo añadir saldo correctamente</div>');
            setTimeout(function(){
                $('#saldoadd').fadeOut('fast');
                }, 4000
                );
        </script>
<?php
            }
        }
    }
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        $c = new Cliente($_SESSION['user']);
        $saldoAdd = $_POST['saldo-add'];
        if( is_numeric($saldoAdd) && $saldoAdd > 0 && $c->addSaldo($saldoAdd) ){
            header('Location: ' . $_SERVER['PHP_SELF'] . '?saldoadd=1');
            exit;
        }else{
            header('Location: ' . $_SERVER['PHP_SELF'] . '?saldoadd=0');
            exit;
        }
    }
?>
