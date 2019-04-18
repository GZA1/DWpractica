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
                
            }
    }

    // $usuario = new Usuario($_SESSION['id']);
    
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
            $("#registrarEmpleadoForm").fadeIn();
            // $("#añadirTienda").fadeOut();
            
        });         
        $("#cancelButtonREMP").click(function(){
            $("#registrarEmpleadoForm").fadeOut();
        });  

    });
    
    
    </script>
</head>
<body>
    <div id="contenedor-inic" class=flex_cols>
        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
        <div id="logo-inic">
            <a href="../main/index.php">
                <img src="../img/logo_horizontal.png" width="100%">
            </a>
        </div>
        <!-- Configuracion de administrador -->
        <?php            
            if($c->getTipo() == "empleado" && $c->getisAdministrador()){
        
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
            $('head').before('<div id="newEmp" style="width: 100%; height: 20px; color: #56ed2d; background-color: #e0e0d2; padding: 10px;">Empleado Registrado</div>');        
            setTimeout(function(){
                $('#newEmp').fadeOut('fast');
                }, 4000
                );        
        </script>  
<?php            
            }
        }
    }else if( $_SERVER['REQUEST_METHOD']=='POST') {
        switch($_POST['optsSubmit']){
            case 'Añadir Empleado':
            if($c->compararPass(sha1($_POST['ContraseñaConfirm']))){
                $newEmpleado = new Empleado();
                $newEmpleado ->setUsername($_POST['Username'])
                             ->setPasswd($_POST['Passwd']) 
                             ->setNombre($_POST['Nombre']) 
                             ->setApell($_POST['Apellidos']) 
                             ->setApell($_POST['Email']) 
                             ->setApell($_POST['PhotoPath']) 
                             ->setApell($_POST['Cargo']);
                if($c->registrarEmpleado($newEmpleado)){
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