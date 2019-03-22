<?php
    require_once('/xampp/appdata/model/Usuario.php');
    require_once('/xampp/appdata/model/Console.php');


    if( $_SERVER['REQUEST_METHOD']=='GET') {
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
        <link rel="stylesheet" href="../styles/style-inicio-sesion.css">
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
                    <input type="text" id="id" name="id">
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
                            id = $("#id").val(),
                            passwd = $("#passwd").val(),
                            passwd2 = $("#passwd2").val();

                        var inputVal = [nombre, apell, email, domicilio, id, passwd, passwd2],
                            inputMessage = ["nombre", "apellidos", "email", "domicilio", "id", "passwd", "passwd2"],
                            textId = ["#lNombre", "#lApell", "#lEmail", "lDomic", "#lId", "#lPasswd", "#lPasswd2"];

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
                            var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
                            return regex.test(email);
                        }
                    });

                    $("input[type='text']").change(function() {
                        $("#error").remove();
                    });

                })(jQuery);
 
            </script>
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
                    <a href="../main/privacy-policy.php" target="_blank">Política de Privaidad</a>
                    <a href="http://www.uemc.es" target="_blank">Universidad Europea Miguel de Cervantes</a>
                    <a href="https://creativecommons.org/choose/zero/?lang=es" target="_blank"><img src="../img/CC0.png" alt="cc0" width="15px"></a>
                </div>
            </div>
        </footer>
    </body>
</html>
<?php
    }
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        $u = new Cliente();
        $u  ->setUsername($_POST['id'])
            ->setPasswd($_POST['passwd'])
            ->setNombre($_POST['nombre'])
            ->setApell($_POST['apell'])
            ->setEmail($_POST['email'])
            ->setdomicilio($_POST['domicilio'])
        ;
        $u->encryptPasswd();
        if( $u->add() ) {
            header('Location: sign-in.php?usrreg=1');
            exit;
        }
        else {
            echo "Error: Falló la operación";
        }
    }
?>