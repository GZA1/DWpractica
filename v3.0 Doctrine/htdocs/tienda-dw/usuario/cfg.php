<?php

require_once('/xampp/appdata/model/console.php');
    require_once '../dbconfig.php';

    use Entity\Usuario;
    use Entity\Cliente;
    use Entity\Empleado;
    use Entity\Admin;
    use Entity\Tienda;
    use Entity\Ubicacion;
    $em = GetEntityManager();
    session_start();

    $u = null;
    $ubicacion = null;
   
    if(isset($_SESSION['user'])){
        $usuarioRep = $em->getRepository("Entity\\Usuario");
        $tiendaRep = $em->getRepository("Entity\\Tienda");
        $ubicacionRep = $em->getRepository("Entity\\Ubicacion");
        $u = $_SESSION['user'];
        $tipo = $u->getTipo();
        $username = $u->getUsername();
            if($tipo == "cliente"){
                $clienteRep = $em->getRepository("Entity\\Cliente");
                $c = $clienteRep->findByUser($u);
            }else if($tipo == "empleado"){
                $empleadoRep = $em->getRepository("Entity\\Empleado");
                $e = $empleadoRep->findByUser($u);
            }
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
                $('head').before('<div id="empNoExist" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #e0e0d2; padding: 10px;">Empleado no encontrado O ERES TÚ MISMO!</div>');        
                setTimeout(function(){
                    $('#empNoExist').fadeOut('fast');
                    }, 4000
                    );        
            </script>  
<?php
        }
    }
?>
    <div id="contenedor-inic" class="flex_cols heightmax">
        <div style="height: 10vh; min-height: 70px; visibility: hidden"></div>
        <div id="logo-inic">
            <a href="../main/index.php">
                <img src="../img/logo_horizontal.png" width="100%">
            </a>
        </div>
        <!-- Configuracion de administrador -->
        <?php            
            if( ! isset($c) && $e->getisAdministrador()){
                require_once("cfgAdmin.php");
            }

        ?>
        
    </div>
</body>
</html>

<?php
    }else if( $_SERVER['REQUEST_METHOD']=='POST') {
        if(isset($_POST['optsSubmit'])){
            switch($_POST['optsSubmit']){
                case 'Añadir Empleado':
                    if( $u->getPasswd() == sha1($_POST['ContraseñaConfirm']) ){
                        $newEmpleado = new Empleado();
                        $newUsuario = new Usuario();
                        $tiendaSeleccionada = $tiendaRep->find($_POST['tienda_id']);
                        $newUsuario ->setUsername($_POST['Username'])
                                    ->setPasswd($_POST['Passwd'])
                                    ->encryptPasswd()
                                    ->setNombre($_POST['Nombre']) 
                                    ->setApellidos($_POST['Apellidos'])
                                    ->setTipo('empleado')
                                    ->setEmail($_POST['Email']);
                        
                        if( ! $usuarioRep->exists($newUsuario) ){
                            $usuarioRep->registrarUsuario($newUsuario);
                            $newEmpleado->setUsuario($usuarioRep->findByUsername($newUsuario->getUsername()))
                                        ->setphoto($_POST['photo']) 
                                        ->setCargo($_POST['Cargo'])
                                        ->setTienda($tiendaSeleccionada);
                            console_log((array)$newEmpleado);
                            $empleadoRep->registrarEmpleado($newEmpleado);
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
                    $usBaja = $usuarioRep->find($_POST['idBajaEmpleado']);
                    console_log((array)$usBaja);
                    if( $usBaja != $u && $empleadoRep->darDeBaja($usBaja) ){
                        header('Location: ?empDEL=1');
                        exit;
                    }else{
                        header('Location: ?empDEL=0');
                        exit;
                    }
                
                break;

                case 'Añadir Tienda':
                     console_log("Add tienda");
                     console_log($_POST);
                    if( $u->getPasswd() == sha1($_POST['ContraseñaConfirm']) ){
                         console_log($_POST['CodigoPostal']);
                         console_log($_POST['Municipio']);
                        $cp = $_POST['CodigoPostal'];
                        $ubic = $ubicacionRep->findOneBy(['cp'=>$cp]);
                        console_log((array)$ubic);
                        $newTienda = new Tienda();
                        $newTienda  ->setNombre($_POST['NombreTienda'])
                                    ->setDireccion($_POST['Direccion']) 
                                    ->setEmail($_POST['EmailTienda'])
                                    ->setUbicacion($ubic);
                        if( isset($ubic) && $tiendaRep->registrarTienda($newTienda) ){
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