<?php

    //require_once('/xampp/appdata/model/Saldo.php');
    require_once('dbconfig.php');
    use Entity\Usuario;
    use Entity\Cliente;
    use Entity\Empleado;
    use Entity\Categoria;


    $em = GetEntityManager();

    session_start();

    $c = null;
    $ubicacion = null;
   
    if(isset($_SESSION['user'])){
        $u = new Usuario($_SESSION['user']);
        $tipo = $u->getTipo();
        $username = $u->getUsername();
            if($tipo == "cliente"){
                $u = new Cliente($_SESSION['user']);
            }else if($tipo == "empleado"){
                $u = new Empleado($_SESSION['user']);
                if( $u->getIsAdministrador() ){
                    $u = new Admin($_SESSION['user']);
                }
            }
    }

    // $usuario = new Usuario($_SESSION['user']);
    
    if( $_SERVER['REQUEST_METHOD']=='GET') {
        // $c = $usuario->getLoggedUser();
?>

<html>

    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
        <meta name="keywords" content="hardware components">
        <meta name="robots" content="NoIndex, NoFollow">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="./styles/style-shared.css">
        <link rel="stylesheet" href="./styles/style-cfg.css">
        <link rel="stylesheet" href="./styles/style-perfil.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <script type="text/javascript">
           $("document").ready(function(){
            $("#optAddCAT").click(function(){
                $("#añadirCatForm").fadeIn('fast');
                $("#editCatForm").fadeOut('fast'); 
                $("#removeCatForm").fadeOut('fast');  
                $("#añadirProdForm").fadeOut('fast');  
                $("#editProdForm").fadeOut('fast');  
                $("#remProdForm").fadeOut('fast');  
            });         
            $("#optEditCAT").click(function(){
                $("#añadirCatForm").fadeOut('fast'); 
                $("#editCatForm").fadeIn('fast');
                $("#removeCatForm").fadeOut('fast');  
                $("#añadirProdForm").fadeOut('fast');  
                $("#editProdForm").fadeOut('fast');  
                $("#remProdForm").fadeOut('fast');  
            });   
            $("#optRemCAT").click(function(){
                $("#añadirCatForm").fadeOut('fast');
                $("#editCatForm").fadeOut('fast'); 
                $("#removeCatForm").fadeIn('fast');
                $("#añadirProdForm").fadeOut('fast');  
                $("#editProdForm").fadeOut('fast');  
                $("#remProdForm").fadeOut('fast');  
            });
            $("#optAddPROD").click(function(){
                $("#añadirCatForm").fadeOut('fast'); 
                $("#editCatForm").fadeOut('fast'); 
                $("#removeCatForm").fadeOut('fast');  
                $("#añadirProdForm").fadeIn('fast'); 
                $("#editProdForm").fadeOut('fast');  
                $("#remProdForm").fadeOut('fast');  
            });         
            $("#optEditPROD").click(function(){
                $("#añadirCatForm").fadeOut('fast');
                $("#editCatForm").fadeOut('fast'); 
                $("#removeCatForm").fadeOut('fast');  
                $("#añadirProdForm").fadeOut('fast');  
                $("#editProdForm").fadeIn('fast');  
                $("#remProdForm").fadeOut('fast');  
            });       
            $("#optRemPROD").click(function(){
                $("#añadirCatForm").fadeOut('fast');  
                $("#editCatForm").fadeOut('fast'); 
                $("#removeCatForm").fadeOut('fast');  
                $("#añadirProdForm").fadeOut('fast');  
                $("#editProdForm").fadeOut('fast');  
                $("#remProdForm").fadeIn('fast');
            });         
        });
        

        
        
        </script>
    </head>
    <body>
        <div id="contenedor-inic" class="flex_cols heightmax">
            <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
            <div id="logo-inic">
                <a href="../main/index.php">
                    <img src="./img/logo_horizontal.png" width="100%">
                </a>
            </div>
            <div id="dashboard">

                <nav id="topSect">
                    <div id="optsCfg">
                    <div class="optCfg"><a style="display: inline-block;" id="optAddCAT" class="adminOpt">Añadir Categoria</a></div>
                    <div class="optCfg"><a style="display: inline-block;" id="optEditCAT" class="adminOpt">Editar Categoria</a></div>
                    <div class="optCfg"><a style="display: inline-block;" id="optRemCAT" class="adminOpt">Borrar Categoria</a></div>
                    <div class="optCfg"><a style="display: inline-block;" id="optAddPROD" class="adminOpt">Añadir Producto</a></div>
                    <div class="optCfg"><a style="display: inline-block;" id="optEditPROD" class="adminOpt">Editar Producto</a></div>
                    <div class="optCfg"><a style="display: inline-block;" id="optRemPROD" class="adminOpt">Eliminar Producto</a></div>
                    <!--<div class="optCfg"><a style="display: inline-block;" id="optTransPROD" class="adminOpt">Transladar Producto</a></div>-->
              

                    </div>
                </nav>
        
           <div id="botSect">
                
                
                
                <!-- 1º Formulario --- Añadir Categoria -->
                <div id="añadirCatForm" class="configForm" >                    
                    <form method="post" id="aCAT">
                        
                        <label id="newNombre">Nombre de categoria</label>
                        <input type="text" id="nombreCatAdd" name="nombreCATAdd">
                        <label id="newAcronimo">Acrónimo</label>
                        <input type="text" id="acrCatAdd" name="acrCATAdd">
                        <label id="">Descripción</label>
                        <input type="text" id="descCatAdd" name="descCATAdd">

                        <label id="aCPasswdConfirm">Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="aCpasswdConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit2" id="addCategoria" value="Añadir Categoria">
                        <input class="submitCDF cancel" id="cancelButtonACAT" type="button" value="Cancelar">
                    </form>
                </div>

                <!-- 2º Formulario --- Editar Categoria -->
                <div id="editCatForm" class="configForm not-active">                    
                    <form method="post" id="eCAT">
                        <label id="CAT">Categoría </label> <br>
                        <select id="categoriaElegida" name="cat_elegEdit" form="eCAT">
                            <?php
                            $categorias = $em->getRepository("Entity\\Categoria")->findAll();
                             foreach($categorias as $c){ ?>
                                <option value=" <?php echo $c->getAcronimo() ?>">  <?php echo $c->getAcronimo() ?></option>";
                            <?php 
                            }
                            ?>        
                        </select>
                        <label id="newNombre">Nombre de categoria</label>
                        <input type="text" id="nombreCatEdit" name="nombreCATEdit">
                        <label id="newAcronimo">Acrónimo</label>
                        <input type="text" id="acrCatEdit" name="acrCATEdit">
                        <label id="">Descripción</label>
                        <input type="text" id="descCatEdit" name="descCATEdit">

                        <label id="eCPasswdConfirm">Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="eCpasswdConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit2" id="editCategoria" value="Editar Categoria">
                        <input class="submitCDF cancel" id="cancelButtonECAT" type="button" value="Cancelar">
                    </form>
                </div>

                <!-- 3º Formulario --- Eliminar Categoria -->
                <div id="removeCatForm" class="configForm not-active" >                    
                    <form method="post" id="rCAT">                        
                        <label> Categoria </label><br>
                        <select id="catToRem" name="cat_elegRem" form="eCAT">
                                <?php
                                $categorias = $em->getRepository("Entity\\Categoria")->findAll();
                                foreach($categorias as $c){ ?>
                                    
                                    <option value=" <?php echo $c->getAcronimo() ?>"><?php echo $c->getAcronimo() ?></option>";
                                <?php 
                                }
                                ?>        
                        </select>
                        <label id="rCPasswdConfirm">Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="rCpasswdConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit2" id="remCategoria" value="Eliminar Categoria">
                        <input class="submitCDF cancel" id="cancelButtonRCAT" type="button" value="Cancelar">
                    </form>
                </div>

                <!-- 4º Formulario --- Añadir Producto -->
                <div id="añadirProdForm" class="configForm not-active">                    
                    <form method="post" id="aPROD">
                        
                        <label id="nPrNombre">Nombre de Producto</label>
                        <input type="text" id="nombrePrNuevo" name="nombrePrNEW">
                        <label id="nPrMarca">Marca</label>
                        <input type="text" id="marcaPrNuevo" name="marcaPrNEW">
                        <label id="nPrModelo">Modelo</label>
                        <input type="text" id="modeloPrNuevo" name="modeloPrNEWo">
                        <label id="nPrPrecio">Precio</label>
                        <input type="text" id="precioPrNuevo" name="precioPrNEW">
                        <label id="nPrDescripcion">Descripcion (OPT)</label>
                        <input type="text" id="descripcionPrNuevo" name="descripcionPrNEW">
                        <label id="nPrPicPath">Path de la Foto (OPT)</label>
                        <input type="text" id="picpathPrNuevo" name="picpathPrNEW">
                        <select id="nPrCat" name="cat_prod" form="aPROD">
                            <?php 
                                $categorias = $em->getRepository("Entity\\Categoria")->findAll();
                                foreach($categorias as $c){ ?>
                                    <option value=" <?php echo $c->getAcronimo() ?>"> Categoria <?php echo $c->getId().$c->getAcronimo(); ?></option>";
                            <?php 
                                }
                            ?>
                        </select>
                        <label id="aPPasswdConfirm">Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="aPpasswdConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit2" id="addProducto" value="Añadir Producto">
                        <input class="submitCDF cancel" id="cancelButtonAPROD" type="button" value="Cancelar">
                    </form>
                </div>

                <!-- 5º Formulario --- Editar Producto -->
                <div id="editProdForm" class="configForm not-active">                    
                    <form method="post" id="ePROD">
                    <label id="ePrNombre">Nombre de Producto</label>
                        <input type="text" id="nombrePrEdit" name="nombrePrEDIT">
                        <label id="ePrMarca">Marca</label>
                        <input type="text" id="marcaPrEdit" name="marcaPrEDIT">
                        <label id="ePrModelo">Modelo</label>
                        <input type="text" id="modeloPrEdit" name="modeloPrEDIT">
                        <label id="ePrPrecio">Precio</label>
                        <input type="text" id="precioPrEdit" name="precioPrEDIT">
                        <label id="ePrDescripcion">Descripcion</label>
                        <input type="text" id="descripcionPrEdit" name="descPrEDIT">
                        <label id="ePrPicPath">Path de la Foto</label>
                        <input type="text" id="picpathPrEdit" name="picpathPrEDIT">
                        <br><label>Categorias disponibles</label><br>
                        <select id="catDisponibles" name="cat_eleg" form="eCAT">
                        <?php 
                            $categorias = $em->getRepository("Entity\\Categoria")->findAll();
                            foreach($categorias as $c){ ?>
                                <option value=" <?php echo $c->getAcronimo() ?>"> Categoria <?php echo "Id:  ".$c->getId()." - ".$c->getAcronimo(); ?></option>";
                        <?php 
                            }
                        ?>
                        </select>
                        <label id="ePPasswdConfirm">Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="ePpasswdConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit2" id="editProducto" value="Editar Producto">
                        <input class="submitCDF cancel" id="cancelButtonEPROD" type="button" value="Cancelar">
                    </form>
                </div>

                <!-- 6º Formulario --- Eliminar Producto -->
                <div id="remProdForm" class="configForm not-active">                    
                    <form method="post" id="rPROD">
                        
                    <select id="prToRem" name="pr_elegRemove" form="eCAT">
                                <?php
                                $productos = $em->getRepository("Entity\\Producto")->findAll();
                                foreach($productos as $p){ ?>
                                    <option value=" <?php echo $p->getNombre() ?>"> <?php echo $p->getNombre() ?></option>";
                                <?php 
                                }
                                ?>        
                        </select> 
                        <label id="rPPasswdConfirm">Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm" id="rPpasswdConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit2" id="updateButton" value="Eliminar Producto">
                        <input class="submitCDF cancel" id="cancelButtonRPROD" type="button" value="Cancelar">
                    </form>
                </div>
           </div>   
        </div>
    </body>

</html>
<?php
}else if( $_SERVER['REQUEST_METHOD']=='POST') {
    console_log('POST');
        console_log($_POST['optsSubmit2']);
        if(isset($_POST['optsSubmit2'])){
            switch($_POST['optsSubmit2']){
                case 'Añadir Categoria':
                    $nuevaCategoria = new Categoria();
                    $nuevaCategoria->setNombre($_POST['nombreCATAdd'])
                                    ->setAcronimo($_POST['acrCATAdd'])
                                    ->setDescripcion($_POST['descCATAdd']);
                    $em->persist($nuevaCategoria);
                    $em->flush();
                    header('Location: ?addCat=1');
                break;

                case 'Editar Categoria':                
                
                    $catEdit = $em->findOneBy('acronimo', $_POST['cat_elegEdit']);
                    $catEdit->setNombre($_POST['nombreCATEdit'])
                            ->setAcronimo($_POST['acrCATEdit'])
                            ->setDescripcion($_POST['descCATEdit']);
                    $em->persist($catEdit);
                    $em->flush();
                    header('Location: ?editCat=1');
                
                break;

                case 'Eliminar Categoria':
                    $catRemove = $em->findOneBy('acronimo', $_POST['cat_elegRem']);
                    $em->remove($catRemove);
                    $em->flush();
                    header('Location: ?remCat=1');
                break;
                case 'Añadir Producto':
                    $nuevoProducto = new Producto();
                    $nuevoProducto->setNombre($_POST['nombrePrNEW'])
                                    ->setMarca($_POST['marcaPrNEW'])
                                    ->setModelo($_POST['modeloPrNEW'])
                                    ->setPrecio($_POST['precioPrNEW'])
                                    ->setDescripcion($_POST['descripcionPrNEW'])
                                    ->setPicPath($_POST['picpathPrNEW']);
                    $em->persist($nuevoProducto);
                    $em->flush();
                    header('Location: ?addPr=1');
                       
                break;

                case 'Editar Producto':
                $catEdit = $em->findOneBy('acronimo', $_POST['cat_elegEdit']);
                if(isset($prEdit)){
                    $prEdit->setNombre($_POST['nombrePrEDIT'])
                    ->setMarca($_POST['marcaPrEDIT'])
                    ->setModelo($_POST['modeloPrEDIT'])
                    ->setPrecio($_POST['precioPrEDIT'])
                    ->setDescripcion($_POST['descPrEDIT'])
                    ->setPicPath($_POST['picpathPrEDIT']);
                    $em->persist($prEdit);
                    $em->flush();
                    header('Location: ?editPr=1');
                }else{
                    header('Location: ?editPr=0');
                }
                
                break;

                case 'Eliminar Producto':
                    $prRemove = $em->findOneBy('nombre', $_POST['pr_elegRemove']);
                    $em->remove($prRemove);
                    $em->flush();
                    header('Location: ?removePr=1');
                break;
            }
        }


       
}
    
?>