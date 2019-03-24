<?php
    require_once('/xampp/appdata/model/Console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    require_once('/xampp/appdata/model/Saldo.php');

    session_start();

    if(isset($_SESSION['id']))
        $saldo = new Saldo($_SESSION['id']);
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
        <nav>
            <img id="logo" src="../img/logo.png" width="60">
            <ul id="lista_nav">
                <li class="cont_enlace_interno">
                    <a href="../main/index.php">Inicio</a>
                </li>
                <li class="cont_enlace_interno">
                    <a href="../catalogo/index.php">Catálogo</a>
                </li>
                <li class="cont_enlace_interno">
                    <a href="../servicios/index.php">Servicios</a>
                </li>
                <li class="cont_enlace_interno">
                    <a href="../encuentranos/index.php">Encuéntranos</a>
                </li>
                <li>
                    <form>
                        <input type="search" placeholder="Search">
                    </form>
                </li>
                <li class="dropdown-container">
                    <div class="dropdown">
                        <div class="dropdown-actuador flex_rows">
                            <div>
                                <img href="../usuario/sign-in.php" src="../img/user-icon.png" height="20px">
                            </div>
                            <div class="flex_cols">
                                <div style="height: 7px; visibility: hidden"></div>
                                <div class="down-arrow"></div>
                            </div>
                        </div>
                        <div class="dropdown-contenido">
                            <?php
                                if( !isset($_SESSION['id']) ){
                            ?>
                            <a class="verde" href="../usuario/sign-in.php">Iniciar Sesión</a>
                            <a class="azul" href="../usuario/sign-up.php">Registrarse</a>
                            <?php
                                }else{
                                    $u = new Usuario($_SESSION['id']);
                                    $tipo = $u->getTipoById();
                            ?>
                            <div>
                                <?php
                                    echo("Logueado como " . $tipo . ": <b>" . $u->getUsernameById() . "</b>");
                                ?>
                            </div>
                            <a href="../usuario/perfil.php">Perfil de Usuario</a>
                            <a href="">Historial de Pedidos</a>
                            <a class="rojo" href="../usuario/logout.php">Cerrar Sesión</a>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </li>
                <?php
                    if( isset($u) && $tipo == 'cliente' ){
                ?>
                <li class="dropdown-container">
                    <div class="dropdown">
                        <div class="dropdown-actuador flex_rows">
                            <div>
                                <img src="../img/shopping-trolley.png" height="20px">
                            </div>
                            <div class="flex_cols">
                                <div style="height: 7px; visibility: hidden"></div>
                                <div class="down-arrow"></div>
                            </div>
                        </div>
                        <div class="dropdown-contenido">
                            <a href="../cesta_compra/xxxx-cesta.php">Cesta</a>
                        </div>
                    </div>
                </li>
                <li class="dropdown-container">
                    <div class="dropdown">
                        <div class="dropdown-actuador flex_rows">
                            <div>
                            <img src="../img/monedero-icon.png" height="20px">
                            </div>
                            <div class="flex_cols">
                                <div style="height: 7px; visibility: hidden"></div>
                                <div class="down-arrow"></div>
                            </div>
                        </div>
                        <div class="dropdown-contenido">
                            <div>
                                <?php
                                    echo("Saldo disponible: " . $saldo->getCantidad() . "€");
                                ?>
                            </div>
                            <div class="verde">
                                <form method="post">
                                    <label>Ingresar Saldo</label>
                                    <input name="saldo-add" type="text">
                                    <label>IBAN (el que sea)</label>
                                    <input name="iban" type="text">
                                    <input class="naranja" type="submit" value="Ingresar">
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
                    }
                ?>

            </ul>
        </nav>

        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>

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
                            
                            <label  id="lId">Introduzca su contraseña</label>
                            <input type="password" id="oldPasswd" name="oldPasswd">
                            <label id="lPasswd">Introduzca su nueva contraseña</label>
                            <input type="password" id="newPasswd" name="newPasswd">
                            <label id="lPasswd2">Confirme su nueva contraseña</label>
                            <input type="password" id="newPasswd2" name="newPasswd2"><br><br>
                            <div id="crear-nueva-cuenta">
                                <input id="boton-nueva-pass" type="submit" value="Cambiar contraseña">
                            </div>
                        </form>                    
                    
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
            }
        }
        else if( isset($_GET['saldoadd']) && $_GET['saldoadd']==1  ){
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
    }
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        console_log($saldo->getCantidad());
        $saldo->aumentarCantidad($_POST['saldo-add']);
        console_log($saldo->getCantidad());
        if( $saldo->add() ){
            header('Location: ../main/index.php?saldoadd=1');
            exit;
        }else {
            echo "Error: Falló la operación";
        }
    }
?>
