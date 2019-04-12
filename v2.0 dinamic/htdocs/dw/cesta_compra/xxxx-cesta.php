<?php
    require_once('/xampp/appdata/model/Console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    //require_once('/xampp/appdata/model/Saldo.php');

    session_start();

    $c = null;
    if(isset($_SESSION['id'])){
        $u = new Usuario($_SESSION['id']);
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
        <link rel="stylesheet" href="../styles/style-shared.css">
        <link rel="stylesheet" href="../styles/style-cesta.css">
        <title>Cesta de Compra</title>
    </head>
    <body>
        <?php require_once('../nav/nav.php'); ?>
        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
        <div class="cesta_main_container flex_cols">
            <h2 id="titulo-cesta">Cesta de la compra</h2>
            <div class="flex_rows borde-abajo">
                <div class="separador-horizontal"></div>
                <div id="precio">Precio</div>
                <div id="cantidad">Cantidad</div>
            </div>
            <div class="producto-container flex_rows borde-abajo" name="Maxtor-STSHX-M101TCBM-1TB">
                <div class="flex_rows separador-horizontal">
                    <div class="producto-img">
                        <a href=""><img src="../img/mxtor-m3-portable-1tb-usb-3-0-2-5-1.png" height="100%"></a>
                    </div>
                    <div class="producto-contenido">
                    <ul>
                        <li>
                            <a href="" class="nombre-componente">Maxtor STSHX-M101TCBM - 1 TB, USB 3.0/3.1, Color Negro</a>
                        </li>
                        <li>
                            <span class="categoria-componente">Discos duros</span>
                        </li>
                        <li>
                            <span class="en-stock">En stock</span>
                        </li>
                        <li>
                            <span class="envio">Envío gratis </span>disponible
                        </li>
                    </ul>
                </div>
                </div>
                <div class="producto-precio">
<!--                    44,50€-->
                </div>
                <div class="producto-cantidad">
                    <input class="producto-cantidad-input" type="number" min="0" step="1" value="1" onchange="calcValue()">
                </div>
            </div>
            <div class="producto-container flex_rows borde-abajo" name="Seagate-ExpansionSTEA4000400-4TB">
                <div class="flex_rows separador-horizontal">
                    <div class="producto-img">
                        <a href=""><img src="../img/seagate-expansion-2-5-4tb-usb-3-0.png" height="100%"></a>
                    </div>
                    <div class="producto-contenido">
                    <ul>
                        <li>
                            <a href="" class="nombre-componente">Seagate Expansion STEA4000400 - 4TB, USB 3.0, Color Negro</a>
                        </li>
                        <li>
                            <span class="categoria-componente">Discos duros</span>
                        </li>
                        <li>
                            <span class="en-stock">En stock</span>
                        </li>
                        <li>
                            <span class="envio">Coste de envío: </span><span class="coste-envio">5,50€</span>
                        </li>
                    </ul>
                </div>
                </div>
                <div class="producto-precio">
<!--                    109,00€-->
                </div>
                <div class="producto-cantidad">
                    <input  class="producto-cantidad-input" type="number" min="0" step="1" value="1" onchange="calcValue()">
                </div>
            </div>
            <div class="flex_rows">
                <div class="separador-horizontal-80"></div>
                <div id="subtotal">
                    Subtotal: <input id="subtotal-resultado"  class="sombreado" type="text" readonly>
                </div>
            </div>
            <br>
            <div class="flex_rows">
                <div class="separador-horizontal-80"></div>
                <div href="" id="boton-comprar" class="sombreado" onclick="tramitarPedido()">Tramitar pedido</div>
            </div>
            <br>
            <div class="flex_rows">
                <p id="resumen-pedido-tramitado"></p>
            </div>
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
        <script src="cesta-logica.js"></script>
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
        $c = new Cliente($_SESSION['id']);
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
