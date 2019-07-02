<?php
    require_once('/xampp/appdata/model/console.php');

    require_once("../dbconfig.php");

    use Entity\Producto;
    use Entity\Categoria;

    $em = GetEntityManager();
    session_start();

    $c = null;
    if(isset($_SESSION['user'])){
        $u = $_SESSION['user'];
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

                <?php 
                $prodRepo = $em->getRepository("Entity\\Producto");
                if(isset($_GET['cat'])){
                    
                    $prods = $prodRepo->findBy(['categoria'=>$_GET['cat']]);
                    $i = 0;
                        
                            echo "<div class=\"productRow\">";
                    foreach($prods as $p){
                        if($i%3 == 0 && $i!=0){
                            echo "</div>";
                            echo "<div class=\"productRow\">";
                        }

                        if($p->getDescripcion() !== null){
                           $desc = $p->getDescripcion();
                        }else{
                            $desc = "";
                        }
                        
                        if($p->getPhoto() !== null){
                            $picPath = $p->getPhoto();
                        }else{
                            $picPath = "";
                        }
                        echo "<div class=\"product\">
                                <a href=\"producto.php?pr=".$p->getId()."\"><img src=\"".$picPath."\" alt=\"not found\"></a>
                                <p class=\"proTitulo\">".$p->getNombre()."</p>
                                <p class=\"proDescripcion\">".$desc."</p>
                                <p class=\"proPrecio\">".$p->getPrecio()."€</p>
                            </div>";
                        $i++;
                    }
                }else{
                    echo "Error, sin categoria";
                }
                

                
                ?>



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
