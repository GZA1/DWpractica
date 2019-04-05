<?php
    require_once('/xampp/appdata/model/Console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    require_once('/xampp/appdata/model/Saldo.php');

    session_start();

    $usuario = new Usuario($_SESSION['id']);

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
        <link rel="stylesheet" href="../styles/style-shared.css">
        <link rel="stylesheet" href="../styles/style-perfil.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Página principal</title>
    </head>
    <body>

        
        <div class="flex_cols" id="contenedor-inic">
                <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
            <div id="logo-inic">
                <a href="../main/index.php">
                    <img src="../img/logo_horizontal.png" width="100%">
                </a>
            </div>
            <div id="mainSection"> 
                <div id="leftSect">
                    <div id="userSummary"></div>
                    <ul id="opcionesPerfil">
                        <li class="pestañasPerfil">Perfil</li>
                        <li class="pestañasPerfil">Monedero</li>
                    </ul>
                </div>
                <div id="rightSect">
                    <h2 style="margin: 20px 0 12px 10px;">Cambiar contraseña</h1>
                    <div id="perfilConfig">
                        
                        
                            <form method="post" id="cambiarPass">
                                <label id="lPasswd">Introduzca su nueva contraseña</label>
                                <input type="password" id="newPasswd" name="newPasswd">
                                <label id="lPasswd2">Confirme su nueva contraseña</label>
                                <input type="password" id="newPasswd2" name="newPasswd2"><br><br>
                                <input id="boton-nueva-pass" type="submit" value="Cambiar contraseña">
                            </form>                    
                        
                    </div>
                </div>
    
            </div>
        </div>


        <!-- <div class="flex_cols">
            <div class="flex_rows" id="contenedor_main_ads">
            <div id="sideContainer">

            </div>

            <div class="mainContainer">
                <div id="contenidoMain" class="flex_cols transition">


                </div>
            </div>
          </div>
        </div> -->
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
        <footer class="pageFoot">
            <div class="flex_cols">
                <div class="flex_rows" id="footer_info">
                    <div class="footer_container">
                        <div class="head">
                            Componentes
                        </div>
                        <div class="content">
                            <ul>
                                <li><a href="">Placas base</a></li>
                                <li><a href="">Procesadores</a></li>
                                <li><a href="">Discos duros</a></li>
                                <li><a href="">Tarjetas gráficas</a></li>
                                <li><a href="">Memorias RAM</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer_container">
                        <div class="head">
                            Contacto
                        </div>
                        <div class="content">
                            <ul>
                                <li><a href="">Teléfono: 999887766</a></li>
                                <li><a href="">E-mail: example@mail.com</a></li>
                                <li><a href=""><img src="../img/facebook.png" width="20px"></a></li>
                                <li><a href=""><img src="../img/twitter.png" width="20px"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer_container">
                        <div class="head">
                            ¿Dónde estamos ubicados?
                        </div>
                        <div class="content">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2982.3770409752533!2d-4.717704684502627!3d41.62598097924306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4712d844c78375%3A0x8532df1684bc7224!2sUniversidad+Europea+Miguel+de+Cervantes+-+UEMC!5e0!3m2!1ses!2ses!4v1547635284329" width="90%" height="80%" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
                <div id="footer_copyright">
                    <a href="../main/privacy-policy.php" target="_blank">Política de Privacidad</a>
                    <a href="http://www.uemc.es" target="_blank">Universidad Europea Miguel de Cervantes</a>
                    <a href="https://creativecommons.org/choose/zero/?lang=es" target="_blank"><img src="../img/CC0.png" alt="cc0" width="15px"></a>
                </div>
            </div>
        </footer>
    </body>
</html>
    <?php
        if( isset($_GET['passwdchange']) ){
            if($_GET['passwdchange']==1){
    ?>
    <script>
        $('head').before('<div id="passwdchange" style="width: 100%; height: 20px; color: #56ed2d; background-color: #1e1e15; padding: 10px;">Contraseña cambiada con éxito</div>');
        setTimeout(function(){
            $('#passwdchange').fadeOut('fast');
            }, 4000
            );
    </script>
<?php
            }
        }
    }
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        if( $_POST['newPasswd'] == $_POST['newPasswd2'] && $usuario->changePasswd($_POST['newPasswd']) ){
            header('Location: ?passwdchange=1');
            exit;
        }else {
            echo "Error: Falló la operación";
        }
    }
?>
