<?php
    require_once('/xampp/appdata/model/console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    require_once('/xampp/appdata/model/Cliente.php');
    require_once('/xampp/appdata/model/Empleado.php');
    

    session_start();

    $u = null;
   
    if(isset($_SESSION['id'])){
        $u = new Usuario($_SESSION['id']);
        $tipo = $u->getTipo();
        $username = $u->getUsername();
            if($tipo == "cliente"){
                $u = new Cliente($_SESSION['id']);
            }else if($tipo == "empleado"){
                $u = new Empleado($_SESSION['id']);
                if( $u->getIsAdministrador() ){
                    $u = new Admin($_SESSION['id']);
                }
            }
    }

    // $usuario = new Usuario($_SESSION['id']);
    
    if( $_SERVER['REQUEST_METHOD']=='GET') {
        // $u = $usuario->getLoggedUser();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Gonzalo Senovilla, Miguel Vitores">
        <meta name="keywords" content="hardware components">
        <meta name="robots" content="NoIndex, NoFollow">
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="/dw/img/logo.png" type="image/png">
        <link rel="stylesheet" href="../styles/style-shared.css">
        <link rel="stylesheet" href="../styles/style-perfil.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

        <title>Perfil de <?php echo($username) ?></title>
        <script type="text/javascript">
        $("document").ready(function(){

            $("#optChangePass").click(function(){
                $(".profileForm").fadeOut();
                $("#cambiarPassForm").fadeIn();
            });
                
            $("#optChangeData").click(function(){
                $(".profileForm").fadeOut();
                $("#cambiarDataForm").fadeIn();
            }); 
            $("#optAddEMP").click(function(){
                $(".profileForm").fadeOut();
                $("#registrarEmpleadoForm").fadeIn();
            }); 
            $(".cancel").click(function(){
                $(".profileForm").fadeOut();
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
                        <p class="attr"><?php echo $u->getUsername();?></p>
                    </div>
                    <div class="profileAttr">
                        <div class="attrName attr">Nombre:</div>
                        <p class="attr"><?php echo $u->getNombre();?></p>
                    </div>
                    <div class="profileAttr">
                        <div class="attrName attr">Apellidos:</div>
                        <p class="attr"><?php echo $u->getApell();?></p>
                    </div>

                    <div class="profileAttr">
                        <div class="attrName attr">Email:</div>
                        <p class="attr"><?php echo $u->getEmail();?></p>
                    </div>
                    <?php
                    if($tipo == "cliente"){
                    ?>
                    <div class="profileAttr">
                        <div class="attrName attr">Domicilio:</div>
                        <p class="attr"><?php echo $u->getDomicilio();?></p>
                    </div>

                    <?php
                    }
                    ?>

                </div>
                <div id="OPTS_profile">
                    <a class="concreteOpt" id="optChangePass">Cambiar contraseña</a>
                    <a class="concreteOpt" id="optChangeData">Modificar datos</a>
                </div>



                <div id="cambiarDataForm" class="profileForm">
                    <h3 style="margin: 0px 0 2vh 0;">Actualizar datos del perfil</h3>
                    <form method="post" id="cDF">

                        <label>Nombre de usuario</label>
                        <input type="text" value="<?php echo htmlspecialchars($u->getUsername());?>" name="Username">
                        <label>Nombre</label>
                        <input type="text" value="<?php echo htmlspecialchars($u->getNombre());?>" name="Nombre">
                        <label>Apellidos</label>
                        <input type="text" value="<?php echo htmlspecialchars($u->getApell());?>" name="Apellidos">
                        <?php
                        if($u->getTipo() == "cliente"){
                            ?>
                        <label>Domicilio</label>
                        <input type="text" value="<?php echo htmlspecialchars($u->getDomicilio());?>" name="Domicilio">
                        <?php
                        }
                        ?>
                        <label>Introduzca su contraseña para confirmar</label>
                        <input type="password" placeholder="Contraseña" name="ContraseñaConfirm">
                        <input class="submitCDF" type="submit" name="optsSubmit" id="updateButton" value="Actualizar Perfil">
                        <input class="submitCDF cancel" id="cancelButton" type="button" value="Cancelar">
                    </form>
                </div>

                
                <div id="cambiarPassForm" class="profileForm">
                    <h3 style="margin: 0px 0 2vh 0;">Cambiar contraseña</h3>
                    <form method="post" id="cambiarPass">
                        <label id="lPasswd">Introduzca su antigua contraseña</label>
                        <input type="password" id="oldPasswd" name="oldPasswd">
                        <label id="lPasswd">Introduzca su nueva contraseña</label>
                        <input type="password" id="newPasswd" name="newPasswd">
                        <label id="lPasswd2">Confirme su nueva contraseña</label>
                        <input type="password" id="newPasswd2" name="newPasswd2"><br>
                        <input class="submitCDF" type="submit" name="optsSubmit" value="Cambiar contraseña">
                        <input class="submitCDF cancel" id="cancelButtonPasswd" type="button" value="Cancelar">
                    </form>
                </div>
            </div>
        </div>
    </body>
        <?php require_once("../footer/footer.php"); ?>
</html>
    <?php
        if(isset($_GET['updateProfile'])){
            if($_GET['updateProfile'] == 1){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="updateProfile" style="width: 100%; height: 20px; color: #2fbf2f; background-color: #e0e0d2; padding: 10px;">Perfil Actualizado</div>');        
            setTimeout(function(){
                $('#updateProfile').fadeOut('fast');
                }, 4000
                );        
        </script>      
    <?php
            }
        }else if(isset($_GET['passwdchange'])){
            if($_GET['passwdchange'] == 0){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="passwdchange" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #e0e0d2; padding: 10px;">No se pudo cambiar la contraseña</div>');        
            setTimeout(function(){
                $('#passwdchange').fadeOut('fast');
                }, 4000
                );        
        </script>      
    <?php
            } else if($_GET['passwdchange'] == 1){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="passwdchange" style="width: 100%; height: 20px; color: #2fbf2f; background-color: #e0e0d2; padding: 10px;">Contraseña modificada con éxito</div>');        
            setTimeout(function(){
                $('#passwdchange').fadeOut('fast');
                }, 4000
                );        
        </script>      
    <?php
            }
        }else if(isset($_GET['confirmpasswd'])){
            if($_GET['confirmpasswd'] == 0){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="confirmpasswd" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #e0e0d2; padding: 10px;">Contraseña de confirmación incorrecta</div>');        
            setTimeout(function(){
                $('#confirmpasswd').fadeOut('fast');
                }, 4000
                );        
        </script>  
    <?php
            }
        }else if(isset($_GET['opfallida'])){
            if($_GET['opfallida'] == 1){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="opfallida" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #e0e0d2; padding: 10px;">Operación fallida</div>');        
            setTimeout(function(){
                $('#opfallida').fadeOut('fast');
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
                if($u->compararPass(sha1($_POST['ContraseñaConfirm']))){
                    if( $tipo == "cliente"  && $u->updatePerfilCliente($_POST['Username'], $_POST['Nombre'], $_POST['Apellidos'], $_POST['Domicilio']) ){
                        header('Location: ?updateProfile=1');
                        exit;
                    }else if( $tipo == "empleado"  && $u->updatePerfilEmpleado($_POST['Username'], $_POST['Nombre'], $_POST['Apellidos']) ){
                        header('Location: ?updateProfile=1');
                        exit;
                    }else{                        
                        header('Location: ?opfallida=1');
                        exit;
                    }
                }else{
                    header('Location: ?confirmpasswd=0');
                    exit;
                }
            break;            
               
            case 'Cambiar contraseña':
                console_log($_POST['oldPasswd']);
                console_log($_POST['newPasswd']);
                if( $u->compararPass(sha1($_POST['oldPasswd'])) ){
                    if( $_POST['newPasswd'] == $_POST['newPasswd2'] && $u->changePasswd($_POST['newPasswd']) ){
                        header('Location: ?passwdchange=1');
                        exit;
                    }else {
                        header('Location: ?passwdchange=0');
                        exit;
                    }
                }else{
                    header('Location: ?confirmpasswd=0');
                    exit;
                }        
            break;            
                        
        }
    }
?>
