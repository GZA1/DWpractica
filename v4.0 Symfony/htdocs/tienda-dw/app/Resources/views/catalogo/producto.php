<?php
    require_once('/xampp/appdata/model/console.php');

    require_once("../dbconfig.php");

    use Entity\Producto;
    use Entity\Categoria;
    use Entity\Unidad;
    use Entity\Tienda;


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

    

    <title>Catálogo</title>
    <script type="text/javascript">
            $("document").ready(function() {

                $("#dCMenos").click(function() {
                    var campo = $("#dCShow");
                    var valorCampo = $("#dCShow").val();
                    if (valorCampo > 0) {
                        valorCampo--;
                        campo.val(valorCampo);
                    }

                });
                $("#dCMas").click(function() {
                    var campo = $("#dCShow");
                    var valorCampo = $("#dCShow").val();
                    valorCampo++;
                    campo.val(valorCampo);
                });


                /*Stock en tiendas*/
                $("#prNdElement").click(function() {
                    var showInfo = $("#prStockEspecifico");
                    showInfo.fadeToggle(1000);
                });
                

                $("#segundaPestaña").click(function(){
                    $("#lasReviews").fadeIn();
                    $("#detallesAdContent").fadeOut();
                });
                
                $("#primeraPestaña").click(function(){
                    $("#detallesAdContent").fadeIn();
                    $("#lasReviews").fadeOut();
                });    
            });

            
        </script>
</head>

<body>
    <?php require_once('../nav/nav.php'); ?>


    <!--            Este contiene los divs laterales-->
    <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>

    <div class="mainProductoWrapper">


<?php
          $prodRepo = $em->getRepository("Entity\\Producto");
          $stockRepo = $em->getRepository("Entity\\Unidad");
          $tiendasRepo = $em->getRepository("Entity\\Tienda");
          if(isset($_GET['pr'])){
              $prod = $prodRepo->findOneBy(['id'=>$_GET['pr']]);
              $stockProd = $stockRepo->findBy(['producto'=>$prod->getId()]);
              
              echo "<div class=\"prodContainer\">";
                echo "<div class=\"maxedMini\">";
                    echo "<img src=\"".$prod->getPicpath()."\">";
                echo "</div>";
?>
                <div class="prodMiniaturas flex_rows">
                    <img src="../img/externos/5.jpg">
                    <img src="../img/externos/maxtor/maxtor1.jpg">
                    <img src="../img/externos/maxtor/maxtor2.jpg">
                    <img src="../img/externos/maxtor/maxtor3.jpg">

                </div>
             </div> 
             <div class="prodDescriptionWrapper">             
<?php
                echo "<h1 id=\"desTitulo\" style=\"padding: 8px 8px 8px 8px;\">".$prod->getNombre()."</h1>";
                echo "<h2 id=\"desDesc\" style=\"padding: 8px 8px 8px 8px;\">".$prod->getPrecio()."€</h2>";
?>
            <div style="border: solid; border-color: #6600cc; border-width: 3px 0; height: 0.5vh; width: 100%; margin: 10px 0"></div>
            <div id="desCantidadesWrapper">
                <span id="desCantidad">Cantidad: </span>
                <div id="dCant2">
                    <a id="dCMenos">-</a>
                    <div id="dCcampo">
                        <input id="dCShow" min="0" value="1">
                    </div>
                    <a id="dCMas">+</a>

                </div>
            </div>

            <div id="botonesCompras" class="flex_rows">
                <a>Añadir a la cesta</a>
                <a>COMPRAR</a>
            </div>
            <div id="prStockWrapper" class="flex_rows">
                <div id="prStElement">
                    <span style="margin-right: 12px;">Stock:</span>
<?php 
                    echo "<span id=\"prStock\">".sizeOf($stockProd)."</span>";
?>
                    <span>Disponibles</span>
                </div>
                <div id="prNdElement">
                    Descubre donde
                    <span style="font-size: 12px; border-radius: 50%; border: solid transparent;">&or;</span>
                </div>
            </div>
            <div id="prStockEspecifico">
<?php
                foreach($stockProd as $s){
                    if(!isset($arrayTiendas)){
                        $arrayTiendas = array($s->getTienda());
                        
                    }else{
                        if(!in_array($s->getTienda(), $arrayTiendas)){
                            array_push($arrayTiendas, $s->getTienda()); 
                        }
                    }
                }
                if(isset($arrayTiendas)){
                    foreach($arrayTiendas as $at){
                       
                        
                        $cantidadPrTienda = $stockRepo->findBy(['producto'=>$_GET['pr'],'tienda'=>$at->getId()]);
                        
                        echo "<p>".sizeOf($cantidadPrTienda)." Disponibles - ".$at->getNombre()." - ".$at->getDireccion()."</p>";
                    }
                }
                
?>
            </div>
            <div id="infoEnvio">
                <div id="mainEnvio"><img src="../img/Envios/envios1.jpg"></div>
                <div id="restoEnvios">
                    <h1>Envio rápido y seguro</h1>
                    <ul>
                        <li><img src="../img/Envios/envios2.jpg"></li>
                        <li><img src="../img/Envios/envios3.png"></li>
                    </ul>
                </div>
            </div>

        </div>
        <div style="height: 8vh; width: 100%"></div>

        <div id="detallesAdiccionalesWrapper">
            <div id="detallesAdCategorias">
                <span id="primeraPestaña">Detalles del producto</span>
                <span id="segundaPestaña">Reviews</span>
            </div>
            <!-- <div style="height:60%; border: solid thin black;"></div> -->
            <div id="detallesAdContent">
                <p>
                    <pre style="font-family: 'Lato', sans-serif; font-size: 13px">
        MAXTOR EXTERNAL 2.5" 2TB M3 PORTABLE BACKUP HARD DRIVE - BLACK

        HX-M201TCBM


        En la caja:


        M3 Portable External Hard Drive

        Cable USB

        Guía de instalación rápida

        Software precargado en el disco

        Documentación del usuario en formato electrónico (PDF)




        Maxtor M3 Portable External Hard Drive

        The Maxtor M3 Portable External Hard Drive delivers handy portable storage. 
        It is easy to take wherever you go, and has ample capacity of up to 4TB. 
        The durable black design stands up to the rigors of daily use.




        Handy portable storage

        Durable black design

        SafetyKey TM protection for your data

        SuperSpeed USB 3.0 (Max): 5.0Gb/s



        Compatible con:


        Playstation 4 (as additional external storage for games)

        Xbox one (as additional external storage for games)

        Windows XP/Vista/7/8.1/10

        Apple Time Machine

        Mac OS X (including High Sierra)

        Laptops/Macbooks with USB 2.0 or USB 3.0 Sockets

        Smart TVs

        Android TV Boxes

                    </pre>
                </p>
            </div>
        <div id="lasReviews">
            <div class="review">
                    <h3>Este producto es muy bueno</h3>
                <p>
                    El productó me encantó, muy util.
                </p>
            </div>
            <div class="review">
                    <h3>Envio Rápido</h3>
                <p>
                    2 dias en llegar, gracias.
                </p>
            </div>
            <div class="review">
                    <h3>Rapido y en buen estado</h3>
                <p>
                    Todo en orden.
                </p>
            </div>
        </div>
        
        </div>
        <div id="sugerencias">
            <div><h1>Sugerencias</h1></div>
            <ul id="listaSugerencias">
                <li><img src="../img/externos/3.jpg"></li>
                <li><img src="../img/externos/6.jpg"></li>
                <li><img src="../img/externos/7.jpg"></li>                
            </ul>

        </div>
    
    
    
        
<?php

          }else{
              echo "Error, sin producto";
          }
        
?>
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
