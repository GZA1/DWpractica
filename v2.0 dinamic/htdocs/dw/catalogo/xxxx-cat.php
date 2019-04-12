<?php
    require_once('/xampp/appdata/model/Console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    // require_once('/xampp/appdata/model/Saldo.php');

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
    <link rel="stylesheet" href="../styles/style-catalogo.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <title>Catálogo</title>
    <script>
      $("document").ready(function() {
        $(function(){
          $("#slider-range").slider({
            range: true,
            min: 0,
            max: 900,
            values: [ 75, 300 ],
            slide: function( event, ui ) {
              $( "#sliderCantidad" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
            }
          });
          $("#sliderCantidad").val("$" + $( "#slider-range" ).slider("values", 0) +
          " - $" + $( "#slider-range" ).slider( "values", 1 ) );
        });
      });
    </script>
</head>

<body>
    <?php require_once('../nav/nav.php'); ?>


    <!--            Este contiene los divs laterales-->
    <div style="height: 10vh; min-height: 70px; visibility: hidden">



    </div>
    <div id="flex_cols">
        <div class="flex_rows">

            <div id="filtersWrapper" class="flex_cols">

                <div id="filtersContainer">
                    <div id="filtersHeader">FILTROS</div>
                    <div id="filterBrCrumbsWrapper">
                        <a>Catálogo</a>
                        <span>&gt;</span>
                        <a>Periféricos</a>
                        <span>&gt;</span>
                        <a>Discos duros</a>
                    </div>

                    <div class="filtroItem">
                      <span>Rango de precio:</span>


                      <p>
                        <div id="slider-range"></div>
                        <input type="text" id="sliderCantidad" readonly style="background-color: rgba(46,46,31,0.02); border:0; color: rgba(102,0,204,0.80); font-weight:bold;">
                      </p>

                      <!--
                        <div id="priceSlider">
                            <input type="range" min="0" max="900" value="900" class="slider" id="miSlider">
                            <p>0 -<span id="valor"></span> $</p>
                        </div>
                        <script>
                            var slider = document.getElementById("miSlider");
                            var output = document.getElementById("valor");
                            output.innerHTML = slider.value; // Display the default slider value

                            // Update the current slider value (each time you drag the slider handle)
                            slider.oninput = function() {
                              output.innerHTML = this.value;
                            }
                        </script> -->
                    </div>
                    <div class="filtroItem">
                        <span>Capacidad</span>
                        <ul class="filterOpts">
                            <li>
                                <input type="checkbox" id="a-opt">
                                <label for="a-opt">4 TB</label>
                            </li>
                            <li>
                                <input type="checkbox" id="b-opt">
                                <label for="b-opt">2 TB</label>
                            </li>
                            <li>
                                <input type="checkbox" id="c-opt">
                                <label for="c-opt">1 TB</label>
                            </li>
                            <li>
                                <input type="checkbox" id="d-opt">
                                <label for="d-opt">500 GB</label>
                            </li>
                            <li>
                                <input type="checkbox" id="e-opt">
                                <label for="e-opt">250 GB</label>
                            </li>
                        </ul>





                    </div>
                    <div class="filtroItem">
                        <span>Marcas</span>
                        <ul class="filterOpts">
                            <li>
                                <input type="checkbox" id="a-opt2">
                                <label for="a-opt2">Maxtor</label>
                            </li>
                            <li>
                                <input type="checkbox" id="b-opt2">
                                <label for="b-opt2">Samsung</label>
                            </li>
                            <li>
                                <input type="checkbox" id="c-opt2">
                                <label for="c-opt2">SanDisk</label>
                            </li>
                            <li>
                                <input type="checkbox" id="d-opt2">
                                <label for="d-opt2">Lacie</label>
                            </li>
                            <li>
                                <input type="checkbox" id="e-opt2">
                                <label for="e-opt2">Toshiba</label>

                            </li>
                        </ul>
                    </div>
                    <div class="filtroItem">
                        <span>Velocidad de rotación</span>
                        <ul class="filterOpts">
                            <li>
                                <input type="checkbox" id="a-opt3">
                                <label for="a-opt3">5.200</label>
                            </li>
                            <li>
                                <input type="checkbox" id="b-opt3">
                                <label for="b-opt3">5.400</label>
                            </li>
                            <li>
                                <input type="checkbox" id="c-opt3">
                                <label for="c-opt3">5.400</label>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>

            <!--        Este div contiene la parte central -->
            <div class="mainContainer" style="padding-left: 0">

                <div id="contenidoMainCatalogo">
                    <div id="category">Discos Duros</div>
                    <div class="productRow">
                        <div class="product">
                            <a href="producto.php"><img src="../img/externos/1.jpg"></a>
                            <p class="proTitulo">Lacie sr-200</p>
                            <p class="proDescripcion">2 TB de almacenamiento, 5200RPM</p>
                            <p class="proPrecio">159.99€</p>
                        </div>
                        <div class="product">
                            <a href="producto.php"><img src="../img/externos//2.jpg"></a>
                            <p class="proTitulo">Samsung GG-2</p>
                            <p class="proDescripcion">4TB Almacenamiento a 5200RPM</p>
                            <p class="proPrecio">259.99€</p>
                        </div>

                        <div class="product">
                            <a href="producto.php"><img src="../img/externos/3.jpg"></a>
                            <p class="proTitulo">LG-Predator</p>
                            <p class="proDescripcion">250 GB de almacenamiento ultra rápido para todo lo que necesites</p>
                            <p class="proPrecio">38.99€</p>
                        </div>
                    </div>
                    <div class="productRow">
                        <div class="product">
                            <a href="producto.php"><img src="../img/externos/4.jpg"></a>
                            <p class="proTitulo">WD-Sauvage88</p>
                            <p class="proDescripcion">3TB ultrarápido</p>
                            <p class="proPrecio">200€</p>
                        </div>
                        <div class="product">
                            <a href="producto.php"><img src="../img/externos/5.jpg"></a>
                            <p class="proTitulo">Maxtor 116</p>
                            <p class="proDescripcion">500GB versátil y ágil</p>
                            <p class="proPrecio">459.99€</p>
                        </div>
                        <div class="product">
                            <a href="producto.php"><img src="../img/externos/6.jpg"></a>
                            <p class="proTitulo">ADATA HardSkin v2</p>
                            <p class="proDescripcion">1 TB Robusto y versátil </p>
                            <p class="proPrecio">38.99€</p>
                        </div>
                    </div>
                    <div class="productRow">
                        <div class="product"></div>
                        <div class="product"></div>
                        <div class="product"></div>
                    </div>
<!--
                    <div class="productRow">
                        <div class="product"></div>
                        <div class="product"></div>
                        <div class="product"></div>
                    </div>
                    <div class="productRow">
                        <div class="product"></div>
                        <div class="product"></div>
                        <div class="product"></div>
                    </div>
-->


                </div>
            </div>




            <!--        Este div contiene los anuncios -->
            <aside class="adsLateral adDerecha" style="max-width: 15vw;">
                <ul class="lista_ads">
                    <li class="ad_container">
                        <a href="http://www.uemc.es/" target="_blank" class="ad_enlace">
                            <div><b>ANUNCIO</b></div>
                            <div><img alt="UEMC" width="100%" src="../img/ad1.png"></div>
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
