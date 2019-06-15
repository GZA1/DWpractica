<?php
    require_once("../dbconfig.php");   
    require_once('/xampp/appdata/model/Console.php');
    
    use Entity\Usuario;
    use Entity\Cliente;
    use Entity\Empleado;

    $em = GetEntityManager();
    $usuarioRep = $em->getRepository("Entity\\Usuario");

    session_start();

    $c = null;
    if(isset($_SESSION['user'])){
        $u = $_SESSION['user'];
        $tipo = $u->getTipo();
        $username = $u->getUsername();
    }
    if( $_SERVER['REQUEST_METHOD']=='GET') {
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Página principal</title>
    </head>
    <body>
        <?php require_once('../nav/nav.php'); ?>
        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
        <div class="flex_cols">
            <div class="flex_rows" id="contenedor_main_ads">
            <div id="sideContainer">
                <ul id="lista_side">
                    <li class="sideDiv" >
                        <a id="c1">Conócenos</a>
                    </li>
                    <li class="sideDiv">
                        <a id="c2">Filosofía Comercial</a>
                    </li>
                    <li class="sideDiv">
                        <a id="c3">Historia de la empresa</a>
                    </li>
                    <li class="sideDiv">
                        <a href="../catalogo/index.php">Catálogo</a>
                    </li>
                    <li class="sideDiv">
                        <a href="../encuentranos/index.php">Encuéntranos</a>
                    </li>
                </ul>
            </div>
<!--        Este div contiene la parte central -->
            <div class="mainContainer">
                <div id="contenidoMain" class="flex_cols transition">
                    <div id="firstThing">
                        <img src="../img/logo_horizontal.png" width="100%">
                        <div id="designed-by">
                            <p>Designed by</p>
                            <img src="../img/sv-logo.png" width="60">
                        </div>
                    </div>
                    <div id="secondThing" style="display: none;">
                        <p>

                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam dapibus ante tellus, ut vestibulum massa ullamcorper maximus. Cras mattis eu magna nec lobortis. Integer dictum mattis nisl quis vehicula. Phasellus vulputate bibendum elit et ornare. In eu turpis quis turpis ultrices facilisis in at arcu. Maecenas consequat aliquam nibh non mattis. Donec placerat lorem nec sem commodo, et auctor nulla interdum. Pellentesque iaculis laoreet dui id cursus. Praesent id tristique neque. Phasellus faucibus risus eros. Vivamus rutrum ex metus. Aenean tristique dignissim pharetra. Proin tempus, justo sit amet interdum ullamcorper, tortor augue molestie nisi, eu consequat risus nisi a odio. Etiam commodo finibus ante a feugiat. Duis nisi lectus, pharetra ac quam at, molestie aliquet eros. Vestibulum malesuada lacus non fermentum vestibulum. <br><br><br>

                    Donec sed vehicula elit. Etiam commodo vestibulum mi. Aliquam accumsan tincidunt suscipit. Vestibulum in finibus ante. Donec non nisi sit amet neque faucibus porttitor. Praesent in scelerisque erat. Curabitur in interdum turpis. Integer accumsan tempus fringilla. Ut elit purus, tempor et euismod ut, rutrum quis orci. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc pharetra massa eu vehicula venenatis.

                    Fusce sit amet urna imperdiet, scelerisque tortor nec, iaculis odio. Maecenas ante diam, pellentesque vel arcu quis, viverra gravida sapien. Vivamus hendrerit maximus lacinia. Curabitur facilisis nibh sapien, ac efficitur erat aliquam quis. In suscipit suscipit sapien eu sollicitudin. Suspendisse vulputate magna magna, id sodales magna condimentum et. Suspendisse mattis nec nulla in accumsan. Maecenas vel est aliquet, maximus diam sit amet, ultricies sapien. Quisque tellus mi, mattis quis orci sed, consequat luctus lacus. Vestibulum et nisi congue, iaculis diam sed, accumsan eros. Sed consectetur quam quis enim facilisis, ut auctor augue gravida.<br><br><br>

                    Ut sit amet sapien eu mi tempor consequat vitae vel orci. Nullam non ligula congue, tincidunt justo a, posuere nibh. Quisque ac lorem pharetra, semper tortor sed, viverra justo. Phasellus finibus posuere lorem. Ut ut auctor sem, eu sodales velit. Vestibulum sit amet efficitur augue. Suspendisse eget turpis quis erat hendrerit sollicitudin. Morbi vitae libero nunc. Proin accumsan tincidunt purus non pulvinar. Mauris nec ultrices risus, non ullamcorper est.<br><br><br>


                        </p>
                    </div>
                    <div id="thirdThing" style="display: none;">
                        <img src="https://via.placeholder.com/350x150"  style="max-width: 100%;">
                        <p>
                           Donec sed vehicula elit. Etiam commodo vestibulum mi. Aliquam accumsan tincidunt suscipit. Vestibulum in finibus ante. Donec non nisi sit amet neque faucibus porttitor. Praesent in scelerisque erat. Curabitur in interdum turpis. Integer accumsan tempus fringilla. Ut elit purus, tempor et euismod ut, rutrum quis orci. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nunc pharetra massa eu vehicula venenatis.

                        Fusce sit amet urna imperdiet, scelerisque tortor nec, iaculis odio. Maecenas ante diam, pellentesque vel arcu quis, viverra gravida sapien. Vivamus hendrerit maximus lacinia. Curabitur facilisis nibh sapien, ac efficitur erat aliquam quis. In suscipit suscipit sapien eu sollicitudin. Suspendisse vulputate magna magna, id sodales magna condimentum et. Suspendisse mattis nec nulla in accumsan. Maecenas vel est aliquet, maximus diam sit amet, ultricies sapien. Quisque tellus mi, mattis quis orci sed, consequat luctus lacus. Vestibulum et nisi congue, iaculis diam sed, accumsan eros. Sed consectetur quam quis enim facilisis, ut auctor augue gravida.
                        </p>
                        <img src="https://via.placeholder.com/350x150"  style="max-width: 100%;">
                    </div>
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
        <script type="text/javascript">
            $("document").ready(function() {

                $("#c1").click(function(){
                   $("#secondThing").fadeOut();
                    $("#firstThing").fadeIn();
                    $("#thirdThing").fadeOut();
                });

                $("#c2").click(function(){
                   $("#secondThing").fadeIn();
                    $("#firstThing").fadeOut();
                    $("#thirdThing").fadeOut();
                });

                $("#c3").click(function(){
                   $("#secondThing").fadeOut();
                    $("#firstThing").fadeOut();
                    $("#thirdThing").fadeIn();
                });

            });

        </script>
        </div>
        <?php require_once("../footer/footer.php"); ?>
    </body>
</html>
    <?php
        if( isset($_GET['usrlog']) ){
            if($_GET['usrlog']==1){
    ?>
    <script>
        $('head').before('<div id="usrlog" style="width: 100%; height: 20px; color: #5cff5c; background-color: #1e1e15; padding: 10px;">Logueado con éxito</div>');
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
        $clienteRep = $em->getRepository("Entity\\Cliente");
        $c = $clienteRep->findByUser($_SESSION['user']);
        $saldoAdd = $_POST['saldo-add'];
        if( is_numeric($saldoAdd) && $saldoAdd > 0 ){
            $c->addSaldo($saldoAdd);
            $em->persist($c);
            $em->flush();
            header('Location: ' . $_SERVER['PHP_SELF'] . '?saldoadd=1');
            exit;
        }else{
            header('Location: ' . $_SERVER['PHP_SELF'] . '?saldoadd=0');
            exit;
        }
    }
?>
