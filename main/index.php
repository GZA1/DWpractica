<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
        <meta name="keywords" content="hardware components">
        <meta name="robots" content="NoIndex, NoFollow">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../styles/style-shared.css">
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
                <li>
                    <a id="img_usuario" href="../inicio-sesion/sign-in.php"><img src="../img/user-icon.png" height="20px"></a>
                </li>
                <li>
                    <a id="img_carrito" href="../cesta_compra/xxxx-cesta.php"><img src="../img/shopping-trolley.png" height="20px"></a>
                </li>
            </ul>
        </nav>
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