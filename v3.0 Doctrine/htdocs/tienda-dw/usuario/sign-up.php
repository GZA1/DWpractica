<?php
    require_once('/xampp/appdata/model/Console.php');
    require_once("../dbconfig.php");

    use Entity\Usuario;
    use Entity\Cliente;
    use Entity\Ubicacion;

    $em = GetEntityManager();
    

    if( $_SERVER['REQUEST_METHOD']=='GET') {
        // error_reporting(E_ALL ^ E_NOTICE);
        // $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['HTTP_CLIENT_IP']));
        // console_log($geo);

        // $usuarioRep = $em->getRepository("Entity\\Usuario");
        // $ubicRep = $em->getRepository("Entity\\Ubicacion");
        // console_log((array)$ubicRep->findByMunic($geo['geoplugin_city']));
        // //console_log($ubicRep->findIdByMunic('Valladolid'));
        // //console_log($ubicRep->findIdByMunic('Cuéllar'));
        // console_log((array)$usuarioRep->findByUsername('cli1'));

        // $c = new Cliente();
        // $c  ->setDomicilio('calle')
        //     ->setUsuario($usuarioRep->findByUsername('cli1'))
        //     ->setUbicacion($ubicRep->findByMunic($geo['geoplugin_city']));

        // console_log((array)$c);
        // $em->persist($c);
        // $em->flush();
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
        <link rel="stylesheet" href="../styles/style-usuario.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>Página principal</title>
    </head>
    <body>
        <div class="flex_cols" id="contenedor-inic">
            <div id="logo-inic">
                <a href="../main/index.php">
                    <img src="../img/logo_horizontal.png" width="100%">
                </a>
            </div>
            <div id="contenedor-form">
                <form method="post" id="miFormulario">
                    <h1 style="margin-top: 40px;">Crear cuenta</h1>
                    <label id="lNombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre">
                    <label id="lApell">Apellidos</label>
                    <input type="text" id="apell" name="apell">
                    <label id="lEmail">E-mail</label>
                    <input type="text" id="email" name="email">
                    <label id="lDomic">Domicilio</label>
                    <input type="text" id="domicilio" name="domicilio">
                    <label id="lId">Nombre de usuario</label>
                    <input type="text" id="username" name="username">
                    <label id="lPasswd">Contraseña</label>
                    <input type="password" id="passwd" name="passwd">
                    <label id="lPasswd2">Confirma tu contraseña</label>
                    <input type="password" id="passwd2" name="passwd2"><br><br>
                    <div id="crear-nueva-cuenta">
                        <input id="boton-nueva-cuenta" type="submit" value="Crear una nueva cuenta">
                    </div>
                </form>
            </div>
            <script>
                (function($) {
                    $('#miFormulario').submit(function() {
                        $("#error").remove();
                        var nombre = $("#nombre").val(), 
                            apell = $("#apell").val(),
                            email = $("#email").val(),
                            domicilio = $("#domicilio").val(),
                            id = $("#username").val(),
                            passwd = $("#passwd").val(),
                            passwd2 = $("#passwd2").val();

                        var inputVal = [nombre, apell, email, domicilio, username, passwd, passwd2],
                            inputMessage = ["nombre", "apellidos", "email", "domicilio", "username", "passwd", "passwd2"],
                            textId = ["#lNombre", "#lApell", "#lEmail", "lDomic", "#lUsername", "#lPasswd", "#lPasswd2"];

                        for(var i=0;i<inputVal.length;i++){
                            inputVal[i] = $.trim(inputVal[i]);
                            console.log(inputVal[i]);
                            if ( inputVal[i] == null || inputVal[i] === "") {
                                console.log(inputVal[i] + ' incorrecto');
                                invalidEntry(i);
                                return false;
                            }
                        }
                        if( !isEmail(email) ){
                            console.log("Email incorrecto");
                            invalidEmail();
                            return false;
                        }else if(passwd != passwd2){
                            console.log("Contraseñas incorrectas");
                            notEqual();
                            return false;
                        }
                        console.log("Registro completado");
                        return true;
                        
                        
                        function invalidEntry(i) {
                            console.log(textId[i] + ' incorrecto');
                            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
                        }

                        function invalidEmail(){
                            $("#lEmail").after("<p id='error' style='font-size: 14px; color: red' > Email no válido.</p>");
                        }
                        
                        function notEqual(){
                            $("#lPasswd").after("<p id='error' style='font-size: 14px; color: red' > Las contraseñas no coiniden.</p>");
                        }
                        function isEmail(email) {
                            console.log(email);
                            var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                            return regex.test(email);
                        }
                    });

                    $("input[type='text']").change(function() {
                        $("#error").remove();
                    });

                })(jQuery);
 
            </script>
        </div>
        <?php require_once("../footer/footer.php"); ?>
    </body>
</html>
<?php
        if( isset($_GET['usrreg']) ){
            if($_GET['usrreg']==0){
?>
    <script>
        $('head').before('<div id="usrreg" style="height: 20px; color: #ff7f7f; background-color: #e0e0d2;padding: 10px;">Nombre de usuario o email inválido</div>');
        setTimeout(function(){ 
            $('#usrreg').fadeOut('fast');
            }, 4000
            );
    </script>
<?php
            }
        }
?>
<?php
    }
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        $u = new Usuario();
        $c = new Cliente();
        $usuarioRep = $em->getRepository("Entity\\Usuario");
        $clienteRep = $em->getRepository("Entity\\Cliente");
        $ubicRep = $em->getRepository("Entity\\Ubicacion");

        error_reporting(E_ALL ^ E_NOTICE);
        $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['HTTP_CLIENT_IP']));
        //console_log($geo);
        $munic = $geo['geoplugin_city'];

        
        $u  ->setUsername($_POST['username'])
            ->setPasswd($_POST['passwd'])
            ->encryptPasswd()
            ->setNombre($_POST['nombre'])
            ->setApellidos($_POST['apell'])
            ->setEmail($_POST['email'])
            ->setTipo('cliente')
            ;
            
        if( $usuarioRep->exists($u) ){
            header('Location: ' . $_SERVER['PHP_SELF'] . '?usrreg=0');
            exit;
        }

        $usuarioRep->registrarUsuario($u);
        console_log((array)$usuarioRep->findByUsername($u->getUsername()));

        $c  ->setDomicilio($_POST['domicilio'])
            ->setUsuario($usuarioRep->findByUsername($u->getUsername()))
            ->setUbicacion($ubicRep->findByMunic($munic));

        console_log((array)$c);
        $clienteRep->registrarCliente($c);

        header('Location: sign-in.php?usrreg=1');
        exit;
        }
?>