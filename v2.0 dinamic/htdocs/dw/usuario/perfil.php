<?php
    require_once('/xampp/appdata/model/console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    require_once('/xampp/appdata/model/Cliente.php');
    require_once('/xampp/appdata/model/Empleado.php');
    //require_once('/xampp/appdata/model/Saldo.php');

    session_start();

    $c = null;
   
    if(isset($_SESSION['id'])){
        $u = new Usuario($_SESSION['id']);
        $tipo = $u->getTipo();
        $username = $u->getUsername();
            if($tipo == "cliente"){
                $c = new Cliente($_SESSION['id']);
            }else if($tipo == "empleado"){
                $c = new Empleado($_SESSION['id']);
                if($c->getisAdministrador()){
                    
                }
            }
    }

    // $usuario = new Usuario($_SESSION['id']);
    
    if( $_SERVER['REQUEST_METHOD']=='GET') {
        // $c = $usuario->getLoggedUser();
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
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <title>Página principal</title>
        <script type="text/javascript">
        $("document").ready(function(){

            $("#optChangePass").click(function(){
                $("#cambiarPassForm").fadeIn();
                $("#cambiarDataForm").fadeOut();
            });
                
            $("#optChangeData").click(function(){
                $("#cambiarDataForm").fadeIn();
                $("#cambiarPassForm").fadeOut();
            }); 
            $("#optAddEMP").click(function(){
                $("#cambiarDataForm").fadeOut();
                $("#cambiarPassForm").fadeOut();
                $("#registrarEmpleadoForm").fadeIn();
            }); 
            $("#cancelButton").click(function(){
                $("#cambiarDataForm").fadeOut();
            });   
            $("#cancelButtonREMP").click(function(){
                $("#registrarEmpleadoForm").fadeOut();
            });   
            
        });
        
        </script>
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
                <div id="profileTop">
                    Perfil Usuario
                </div>
                <div id="perfilConfig">



                    <div class="profileAttr">
                        <div class="attrName attr">Nombre de usuario:</div>
                        <p class="attr"><?php echo $c->getUsername();?></p>
                    </div>
                    <div class="profileAttr">
                        <div class="attrName attr">Nombre:</div>
                        <p class="attr"><?php echo $c->getNombre();?></p>
                    </div>
                    <div class="profileAttr">
                        <div class="attrName attr">Apellidos:</div>
                        <p class="attr"><?php echo $c->getApell();?></p>
                    </div>
                    <?php
                    if($tipo == "cliente"){
                    ?>

                    <div class="profileAttr">
                        <div class="attrName attr">Email:</div>
                        <p class="attr"><?php echo $c->getEmail();?></p>
                    </div>
                    <div class="profileAttr">
                        <div class="attrName attr">Domicilio:</div>
                        <p class="attr"><?php echo $c->getDomicilio();?></p>
                    </div>
                    
                    <?php
                    }
                    ?>

                </div>
                <div id="OPTS_profile">
                    <a class="concreteOpt" id="optChangePass">Cambiar contraseña</a>
                    <a class="concreteOpt" id="optChangeData">Modificar datos</a>

                    <!--   Botones de Empleado o Administrador -->
                    <?php
                        if($c->getTipo() == "empleado" && $c->isAdministrador()){
                    ?>
                        <a class="concreteOpt" id="optAddEMP">Registrar Empleado</a>
                    <?php
                    }
                    ?>


                </div>



                <div id="cambiarDataForm" class="profileForm">
                    <h3 style="margin: 0px 0 2vh 0;">Actualizar datos del perfil</h3>
                    <form method="post" id="cDF">

                        <label>Nombre de usuario</label>
                        <input type="text" value="<?php echo htmlspecialchars($c->getUsername());?>" name="Username">
                        <label>Nombre</label>
                        <input type="text" value="<?php echo htmlspecialchars($c->getNombre());?>" name="Nombre">
                        <label>Apellidos</label>
                        <input type="text" value="<?php echo htmlspecialchars($c->getApell());?>" name="Apellidos">
                        <label>Domicilio</label>
                        <input type="text" value="<?php echo htmlspecialchars($c->getDomicilio());?>" name="Domicilio">
                        <label>Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton"
                            value="Actualizar Perfil">
                        <input class="submitCDF" id="cancelButton" type="button" value="Cancelar">
                    </form>
                </div>

                <!--                               Contraseña                            -->
                <div id="cambiarPassForm" class="profileForm">
                    <h3 style="margin: 0px 0 2vh 0;">Cambiar contraseña</h3>
                    <form method="post" id="cambiarPass">
                        <label id="lPasswd">Introduzca su nueva contraseña</label>
                        <input type="password" id="newPasswd" name="newPasswd">
                        <label id="lPasswd2">Confirme su nueva contraseña</label>
                        <input type="password" id="newPasswd2" name="newPasswd2"><br><br>
                        <input class="submitCDF" type="submit" name="optsSubmit" value="Cambiar contraseña">
                    </form>
                </div>
            </div>
        </div>
        <?php
        if($c->getTipo() == "empleado"){
        ?>
        <!--    Menu de Empleado     -->
            
        
        
        
        <?php
        }
        ?>
        <?php
        if($c->getTipo() == "empleado" && $c->isAdministrador){
        ?>
        <!--    Menu de Administrador   -->
        <div id="registrarEmpleadoForm" class="profileForm">
        <h3 style="margin: 0px 0 2vh 0;">Registrar Empleado</h3>
        <form method="post" id="rEMP">

            <label>Nombre de usuario</label>
            <input type="text" name="Username">
            <label>Contraseña</label>
            <input type="text" name="Passwd">
            <label>Nombre</label>
            <input type="text" name="Nombre">
            <label>Apellidos</label>
            <input type="text" name="Apellidos">
            <label>Ruta de foto de perfil</label>
            <input type="text" name="PhotoPath">
            <label>Cargo</label>
            <input type="text" name="Cargo">
            <label>Introduzca su contraseña para confirmar</label>
            <input type="password" placeholder="Contraseña" name="ContraseñaConfirm">
            <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton" value="Añadir Empleado">
            <input class="submitCDF" id="cancelButtonREMP" type="button" value="Cancelar">
        </form>
        
        
        
        <?php
        }
        ?>
        



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
        }else if(isset($_GET['updateProfile'])){
            if($_GET['updateProfile'] == 1){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="updateProfile" style="width: 100%; height: 20px; color: #56ed2d; background-color: #1e1e15; padding: 10px;">Perfil Actualizado</div>');        
            setTimeout(function(){
                $('#updateProfile').fadeOut('fast');
                }, 4000
                );        
        </script>      
    <?php
            }
        }else if(isset($_GET['newEmp'])){
            if($_GET['newEmp'] == 1){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="newEmp" style="width: 100%; height: 20px; color: #56ed2d; background-color: #1e1e15; padding: 10px;">Empleado Registrado</div>');        
            setTimeout(function(){
                $('#newEmp').fadeOut('fast');
                }, 4000
                );        
        </script>      
    <?php
            }
        }
    }
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        switch($_POST['optsSubmit']){
            
            case 'Actualizar Perfil':
                if($c->compararPass(sha1($_POST['ContraseñaConfirm']))){
                    if($c->updatePerfilCliente($_POST['Username'], $_POST['Nombre'], $_POST['Apellidos'], $_POST['Domicilio'])){
                        header('Location: ?updateProfile=1');
                        exit;
                    }else{                        
                        echo "Operacion Fallida";
                    }
                }else{
                    echo "Error: Contraseña Erronea";
                }
            break;            
               
            case 'Cambiar contraseña':
                if( $_POST['newPasswd'] == $_POST['newPasswd2'] && $usuario->changePasswd($_POST['newPasswd']) ){
                    header('Location: ?passwdchange=1');
                    exit;
                }else {
                    echo "Error: Falló la operación";
                }            
            break;            
            case 'Añadir Empleado':
            if($a->compararPass(sha1($_POST['ContraseñaConfirm']))){
                $newEmpleado = new Empleado();
                $newEmpleado ->setUsername($_POST['Username'])
                             ->setPasswd($_POST['Passwd']) 
                             ->setNombre($_POST['Nombre']) 
                             ->setApell($_POST['Apellidos']) 
                             ->setApell($_POST['PhotoPath']) 
                             ->setApell($_POST['Cargo']);
                if($a->registrarEmpleado($newEmpleado)){
                    header('Location: ?newEmp=1');
                    exit;
                }else{
                    echo "Operacion Fallida";
                }
            }else{
                echo "Contraseña Incorrecta";
            }    
            break;            
        }
    }
?>
