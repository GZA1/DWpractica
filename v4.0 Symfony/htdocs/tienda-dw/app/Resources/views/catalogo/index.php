<?php
    require_once("../dbconfig.php");
    
    use Entity\Categoria;
    use Entity\Usuario;
    $em = GetEntityManager();

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
        <link rel="stylesheet" href="../styles/style-catalogo.css">
        <link rel="stylesheet" href="../styles/Carousel.css">

        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="Carousel.js"></script>
        <title>Encuéntranos</title>

        <script type="text/javascript">
            var slideIndex = 3;

            showSlides(slideIndex);

            function plusSlides(n) {
              showSlides(slideIndex += n);
            }

            function currentSlide(n) {
              showSlides(slideIndex = n);
            }

            function showSlides(n) {
              var i;
              var slides = document.getElementsByClassName("mySlides");


              if (n > slides.length) {slideIndex = 3}

                if (n < 1) {slideIndex = slides.length}

              for (i = 0; i < slides.length; i++) {
                  slides[i].style.display = "none";
              }

                if(slideIndex<3) {
                    slides[slideIndex-1].style.display = "block";
                    slides[slideIndex-2].style.display = "block";
                    slides[slideIndex-3].style.display = "block";
                }
                slides[slideIndex-1].style.display = "block";
                slides[slideIndex-2].style.display = "block";
                slides[slideIndex-3].style.display = "block";
            }


            var slideIndex1 = 3;

            showSlides1(slideIndex1);

            function plusSlides1(n) {
              showSlides1(slideIndex1 += n);
            }



            function showSlides1(n) {
              var i;
              var slides1 = document.getElementsByClassName("mySlides1");


              if (n > slides1.length) {slideIndex1 = 3}

                if (n < 1) {slideIndex1 = slides1.length}

              for (i = 0; i < slides1.length; i++) {
                  slides1[i].style.display = "none";
              }

                if(slideIndex<3) {
                    slides1[slideIndex1-1].style.display = "block";
                    slides1[slideIndex1-2].style.display = "block";
                    slides1[slideIndex1-3].style.display = "block";
                }
                slides1[slideIndex1-1].style.display = "block";
                slides1[slideIndex1-2].style.display = "block";
                slides1[slideIndex1-3].style.display = "block";
            }


        </script>
    </head>
    <body>
        <?php require_once('../nav/nav.php'); ?>
        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
        <div class="flex_cols">
            <div class="flex_rows" id="contenedor_main_ads">
<!-- Hey las categorias son aqui-->
                <div id="sideLFTblank">
                    <div id="lftCategorias">
                        <div id="catTitulo">CATEGORIAS</div>
                    <?php 
                        $catRepo = $em->getRepository("Entity\\Categoria");
                        $categorias = $catRepo->findAll();

                        foreach($categorias as $c){
                            echo "<a id=\"linkCategoria\" href=\"xxxx-cat.php?cat=".$c->getId()."\">".$c->getNombre()."</a>";
                        }
                    
                    ?>
                        <!-- <a>Ordenadores</a>
                            <div class="subMenu" id="subOrdenadores">
                                <div>Ordenadores</div>
                                <a href="xxxx-cat.php">Ya construidos</a>
                                <a href="xxxx-cat.php">Portátiles</a>
                                <a href="xxxx-cat.php">Portátiles Gaming</a>
                                <a href="xxxx-cat.php">Ultrabooks</a>
                                <a href="xxxx-cat.php">Convertibles</a>
                                <a href="xxxx-cat.php">Fundas</a>
                                <a href="xxxx-cat.php">Mochilas</a>

                            </div>

                        <a>Componentes</a>
                        <div class="subMenu" id="subComponentes">
                                <div>Componentes</div>

                                <a href="xxxx-cat.php">Procesadores</a>
                                <a href="xxxx-cat.php">RAM</a>
                                <a href="xxxx-cat.php">Targetas Gráficas</a>
                                <a href="xxxx-cat.php">Trajetas de red</a>
                                <a href="xxxx-cat.php">Cajas</a>
                                <a href="xxxx-cat.php">Tarjetas de sonido</a>

                        </div>

                        <a>Cámaras</a>
                        <div class="subMenu" id="subCámaras">
                                <div>Cámaras</div>

                                <a href="xxxx-cat.php">4K</a>
                                <a href="xxxx-cat.php">Foto</a>
                                <a href="xxxx-cat.php">Video</a>
                                <a href="xxxx-cat.php">Cannon</a>
                                <a href="xxxx-cat.php">Nikkon</a>
                                <a href="xxxx-cat.php">Accesorios</a>

                        </div>
                        <a>TV</a>
                        <div class="subMenu" id="subTv">
                                <div>TV</div>

                                <a href="xxxx-cat.php">Mandos</a>
                                <a href="xxxx-cat.php">Periféricos</a>
                                <a href="xxxx-cat.php">4K</a>
                                <a href="xxxx-cat.php">8K</a>
                                <a href="xxxx-cat.php">Full HD</a>
                                <a href="xxxx-cat.php">3D TV</a>

                        </div>
                        <a>Gadgets</a>
                        <div class="subMenu" id="subGadgets">
                                <div>Gadgets</div>

                                <a href="xxxx-cat.php">Cargadores</a>
                                <a href="xxxx-cat.php">Gadgets para el coche</a>
                                <a href="xxxx-cat.php">Linternas</a>
                                <a href="xxxx-cat.php">Supervivencia</a>
                                <a href="xxxx-cat.php">Cables</a>
                                <a href="xxxx-cat.php">Conectores</a>

                        </div>
                        <a>Gaming</a>
                        <div class="subMenu" id="subGaming">
                                <div>Gaming</div>

                                <a href="xxxx-cat.php">Cajas RGB</a>
                                <a href="xxxx-cat.php">Accesorios RGB</a>
                                <a href="xxxx-cat.php">Mods RGB</a>
                                <a href="xxxx-cat.php">Gráficas Gaming</a>
                                <a href="xxxx-cat.php">Procesadores Gaming</a>
                                <a href="xxxx-cat.php">Sillas Gaming</a>

                        </div>
                        <a>Impresoras</a>
                        <div class="subMenu" id="subImpresoras">
                                <div>Impresoras</div>

                                <a href="xxxx-cat.php">A color</a>
                                <a href="xxxx-cat.php">Láser</a>
                                <a href="xxxx-cat.php">Industriales</a>
                                <a href="xxxx-cat.php">Uso doméstico</a>
                                <a href="xxxx-cat.php">Para niños</a>
                                <a href="xxxx-cat.php">Papel</a>

                        </div> -->


                    </div>

                </div>
                <div id="mid">
                    <div id="midFiller"></div>
                    <p >Recomendados</p>
                    <div id="catCarousel">
                        <div class="slideshow-container flex_rows">

                            <div class="mySlides fade">
                                <div class="imaagen"><img src="../img/externos/1.jpg"></div>
                                <div class="text">
                                    <h6>50% Descuento !</h6>
                                    <h5>Maxtor 2TB - 20.99€</h5>

                                </div>
                            </div>

                            <div class="mySlides fade">
                                <div class="imaagen"><img src="../img/externos/2.jpg"></div>
                                <div class="text">
                                        <h6>70% Descuento !</h6>
                                        <h5>SeaGate 1TB - 20.99€</h5>
                                </div>
                            </div>

                            <div class="mySlides fade">
                                <div class="imaagen">
                                    <img src="../img/externos/maxtor/maxtor2.jpg">
                                </div>
                                <div class="text">
                                    <h6>10% Descuento !</h6>
                                    <h5>Maxtor 500GB - 12.99€</h5>
                                </div>
                            </div>

                            <div class="mySlides fade">
                                <div class="imaagen">
                                    <img src="../img/externos/3.jpg">
                                </div>
                                <div class="text">
                                    <h6>50% Descuento !</h6>
                                    <h5>LG 1TB - 20.99€</h5>
                                </div>
                            </div>
                            <div class="mySlides fade">
                                <div class="imaagen">
                                    <img src="../img/externos/4.jpg">
                                </div>
                                <div class="text">
                                    <h6>9% Descuento !</h6>
                                    <h5>Samsung 4TB - 343.99€</h5>
                                </div>
                            </div>
                            <div class="mySlides fade">
                                <div class="imaagen">
                                    <img src="../img/externos/5.jpg" >
                                </div>
                                <div class="text">
                                    <h6>7% Descuento !</h6>
                                    <h5>SeaGate 500GB - 11.99€</h5>
                                </div>
                            </div>
                            <div class="mySlides fade">

                                <div  class="imaagen">

                                   <img src="../img/externos/6.jpg">
                                </div>
                                <div class="text">
                                    <h6>10% Descuento !</h6>
                                    <h5>Maxtor 3TB - 250.99€</h5>
                                </div>
                            </div>


                            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                            <a class="next" onclick="plusSlides(1)">&#10095;</a>

                        </div>
                        <br>
                    </div>



                    <p >Ofertas Flash</p>
                    <div id="catCarousel">
                        <div class="slideshow-container flex_rows">

                            <div class="mySlides1 fade">
                                <div class="imaagen"><img src="../img/ej1.jpg"></div>
                                <div class="text">
                                    <h6>50% Descuento !</h6>
                                    <h5>Maxtor 2TB - 20.99€</h5>

                                </div>
                            </div>

                            <div class="mySlides1 fade">
                                <div class="imaagen"><img src="../img/ej2.jpg"></div>
                                <div class="text">
                                        <h6>70% Descuento !</h6>
                                        <h5>SeaGate 1TB - 20.99€</h5>
                                </div>
                            </div>

                            <div class="mySlides1 fade">
                                <div class="imaagen">
                                    <img src="../img/ej3.png">
                                </div>
                                <div class="text">
                                    <h6>10% Descuento !</h6>
                                    <h5>Maxtor 500GB - 12.99€</h5>
                                </div>
                            </div>

                            <div class="mySlides1 fade">
                                <div class="imaagen">
                                    <img src="../img/ej4.jpg">
                                </div>
                                <div class="text">
                                    <h6>50% Descuento !</h6>
                                    <h5>LG 1TB - 20.99€</h5>
                                </div>
                            </div>
                            <div class="mySlides1 fade">
                                <div class="imaagen">
                                    <img src="../img/ej5.jpg">
                                </div>
                                <div class="text">
                                    <h6>9% Descuento !</h6>
                                    <h5>Samsung 4TB - 343.99€</h5>
                                </div>
                            </div>
                            <div class="mySlides1 fade">
                                <div class="imaagen">
                                    <img src="../img/ej6.jpg" >
                                </div>
                                <div class="text">
                                    <h6>7% Descuento !</h6>
                                    <h5>SeaGate 500GB - 11.99€</h5>
                                </div>
                            </div>
                            <div class="mySlides1 fade">

                                <div  class="imaagen">

                                   <img src="../img/ej7.jpg">
                                </div>
                                <div class="text">
                                    <h6>10% Descuento !</h6>
                                    <h5>Maxtor 3TB - 250.99€</h5>
                                </div>
                            </div>


                            <a class="prev1" onclick="plusSlides1(-1)">&#10094;</a>
                            <a class="next1" onclick="plusSlides1(1)">&#10095;</a>

                        </div>
                        <br>
                    </div>
                    <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>

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
