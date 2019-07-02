<?php
    require_once('/xampp/appdata/model/console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    require_once('/xampp/appdata/model/Cliente.php');
    require_once('/xampp/appdata/model/Empleado.php');
    require_once('/xampp/appdata/model/Admin.php');
    require_once('/xampp/appdata/model/Tienda.php');
    require_once('/xampp/appdata/model/Ubicacion.php');
    //require_once('/xampp/appdata/model/Saldo.php');

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
    <link rel="stylesheet" href="../styles/style-shared.css">
    <link rel="stylesheet" href="../styles/style-cfg.css">
    <link rel="stylesheet" href="../styles/style-perfil.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <script type="text/javascript">
    $("document").ready(function(){
        $("#optAddEMP").click(function(){
            $("#registrarEmpleadoForm").fadeIn('fast');
            $("#añadirTiendaForm").fadeOut('fast'); 
            $("#bajaEMPForm").fadeOut('fast');  
            $("#municForm").fadeOut('fast');  
        });         
        $("#optAddSHOP").click(function(){
            $("#registrarEmpleadoForm").fadeOut('fast');
            $("#añadirTiendaForm").fadeIn('fast');
            $("#bajaEMPForm").fadeOut('fast');
            $("#municForm").fadeOut('fast');
        });         
        $("#optBajaEMP").click(function(){
            $("#registrarEmpleadoForm").fadeOut('fast');
            $("#añadirTiendaForm").fadeOut('fast');
            $("#bajaEMPForm").fadeIn('fast');
            $("#municForm").fadeIn('fast');
        });
        $("#cancelButtonREMP").click(function(){
            $("#registrarEmpleadoForm").fadeOut('fast');
        });
        $("#cancelButtonaSHOP").click(function(){            
            $("#añadirTiendaForm").fadeOut('fast');            
        });
        $("#cancelButtonbajaEMP").click(function(){
            $("#bajaEMPForm").fadeOut('fast');
        });  

    });
    
    
    </script>
</head>
<body>
    <div id="contenedor-inic" class="flex_cols heightmax">
        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
        <div id="logo-inic">
            <a href="../main/index.php">
                <img src="../img/logo_horizontal.png" width="100%">
            </a>
        </div>
        <!-- Configuracion de administrador -->
        <?php            
            if($u->getTipo() == "empleado" && $u->getisAdministrador()){

                require_once("cfgAdmin.php");
        
            }else {
                require_once("cfgEmpleado.php");
            }
        ?>
        
    </div>
</body>
</html>
<?php
        if(isset($_GET['newEmp'])){
           if($_GET['newEmp'] == 1){
    ?>
        <script type="text/javascript">
            $('head').before('<div id="newEmp" style="width: 100%; height: 20px; color: #3ca51f; font-weight: 900; background-color: #e0e0d2; padding: 10px;">Empleado Registrado</div>');        
            setTimeout(function(){
                $('#newEmp').fadeOut('fast');
                }, 4000
                );        
        </script>  
<?php            
            }
        }else if(isset($_GET['newShop'])){
            if($_GET['newShop'] == 1){
?>
            <script type="text/javascript">
                $('head').before('<div id="newShop" style="width: 100%; height: 20px; color: #3ca51f; font-weight: 900; background-color: #e0e0d2; padding: 10px;">Tienda añadida</div>');        
                setTimeout(function(){
                    $('#newShop').fadeOut('fast');
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
    }else if(isset($_GET['empDEL'])){
        if($_GET['empDEL'] == 1){
?>
        <script type="text/javascript">
            $('head').before('<div id="empDeleted" style="width: 100%; height: 20px; color: #3ca51f; background-color: #e0e0d2; padding: 10px;">Empleado dado de baja con éxito</div>');        
            setTimeout(function(){
                $('#empDeleted').fadeOut('fast');
                }, 4000
                );        
        </script>  
<?php
        }else{
?>
            <script type="text/javascript">
                $('head').before('<div id="empNoExist" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #e0e0d2; padding: 10px;">Empleado no encontrado</div>');        
                setTimeout(function(){
                    $('#empNoExist').fadeOut('fast');
                    }, 4000
                    );        
            </script>  
<?php
        }
    }

    }else if( $_SERVER['REQUEST_METHOD']=='POST') {
        console_log('POST');
        console_log($_POST['optsSubmit']);
        if(isset($_POST['optsSubmit'])){
            switch($_POST['optsSubmit']){
                case 'Añadir Empleado':
                    if( $u->compararPass(sha1($_POST['ContraseñaConfirm'])) ){
                        $newEmpleado = new Empleado();
                        $newEmpleado ->setUsername($_POST['Username'])
                                    ->setPasswd($_POST['Passwd']) 
                                    ->setNombre($_POST['Nombre']) 
                                    ->setApell($_POST['Apellidos']) 
                                    ->setEmail($_POST['Email']) 
                                    ->setphoto($_POST['photo']) 
                                    ->setCargo($_POST['Cargo'])
                                    ->setTienda_id($_POST['tienda_id']);
                                    
                        $newEmpleado->encryptPasswd();
                        if( $u->registrarEmpleado($newEmpleado) ){
                            header('Location: ?newEmp=1');
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

                case 'Baja Empleado':
                    if($u->doIDexist($_POST['idBajaEmpleado'])){
                        $emp = new Empleado($_POST['idBajaEmpleado']);
                        $u->bajaEmpleado($emp);                    
                        header('Location: ?empDEL=1');

                    }else{
                        header('Location: ?empDEL=0');
                    }
                
                break;

                case 'Añadir Tienda':
                    console_log("Add tienda");
                    console_log($_POST);
                    if( $u->compararPass(sha1($_POST['ContraseñaConfirm']))){
                        console_log($_POST['CodigoPostal']);
                        console_log($_POST['Municipio']);
                        $ubicacion = new Ubicacion();
                        $ubicacion  ->setCp($_POST['CodigoPostal'])
                                    ->setMunicipio($_POST['Municipio']);
                        $newTienda = new Tienda();
                        $newTienda  ->setNombre($_POST['NombreTienda'])
                                    ->setDireccion($_POST['Direccion']) 
                                    ->setEmail($_POST['EmailTienda'])
                                    ->setIdUbicacion($ubicacion->searchIdByCpMunic());
                        if( $u->añadirTienda($newTienda) ){
                            header('Location: ?newShop=1');
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
            }
        }
    }
    
?>