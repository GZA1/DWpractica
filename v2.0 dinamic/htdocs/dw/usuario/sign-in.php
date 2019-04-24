<?php
    require_once('/xampp/appdata/model/console.php');
    require_once('/xampp/appdata/model/Usuario.php');
    require_once('/xampp/appdata/model/Cliente.php');
    

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
                    <h1 style="margin-top: 40px;">Iniciar sesión</h1>
                    <label id="lUser">Nombre de usuario o mail</label>
                    <input type="text" id="username" name="username" name="username">
                    <label id="lPasswd">Contraseña</label>
                    <input type="password" id="passwd" name="passwd"><br><br>
                    <input id="boton-inic-ses" type="submit" value="Iniciar sesión">
                    <div  class="no-cuenta" >
                        <a style="cursor: pointer;" href="sign-up.php">¿No tienes cuenta todavía?</a>
                    </div>
                </form>
            </div>
            <script>
                 (function($) {
                    $('#miFormulario').submit(function() {
                        $("#error").remove();
                        var nombre = $("#username").val(),
                            passwd = $("#passwd").val();

                        var inputVal = [username, passwd],
                            inputMessage = ["username", "passwd"],
                            textId = ["#lUser", "#lPasswd"];

                        for(var i=0;i<inputVal.length;i++){
                            inputVal[i] = $.trim(inputVal[i]);
                            if ( inputVal[i] == null || inputVal[i] === "") {
                                invalidEntry(i);
                                return false;
                            }
                        }
                        return true;
                        
                        function invalidEntry(i) {
                            console.log(textId[i] + ' incorrecto');
                            $(textId[i]).after("<p id='error' style='font-size: 14px; color: red' > El campo " + inputMessage[i] + " no es válido.</p>");
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
        <?php require_once("../footer/footer.php"); ?>
    </body>
    <?php
        if( isset($_GET['usrreg']) ){
            if($_GET['usrreg']==1){
    ?>
    <script>
        $('head').before('<div id="usrreg" style="height: 20px; color: #0083ff; background-color: #e0e0d2;padding: 10px;">Registrado con éxito, proceda a loguearse</div>');
        setTimeout(function(){ 
            $('#usrreg').fadeOut('fast');
            }, 4000
            );
    </script>
    <?php
            }
        }
        else if( isset($_GET['usrerror']) ){
            if($_GET['usrerror']==1){
    ?>
    <script>
        $('head').before('<div id="unl" style="width: 100%; height: 20px; color: #ff7f7f; background-color: #e0e0d2;padding: 10px;">Usuario y/o contraseña incorrectos</div>');
        setTimeout(function(){ 
            $('#usrreg').fadeOut('fast');
            }, 4000
            );
    </script>
    <?php
            }
        }
    ?>
</html>
<?php
}
    else if( $_SERVER['REQUEST_METHOD']=='POST') {
        $u = new Usuario();
        $u  ->setUsername($_POST['username'])
            ->setPasswd($_POST['passwd'])
        ;


        $u->encryptPasswd();
        if( $u->login() ) {
            session_start();
            $_SESSION['id'] = $u->getId();
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
            console_log($_SESSION['id']);
            cLog($_SESSION['id']);
            header('Location: ../main/index.php?usrlog=1');
            exit;
        }
        else {
            header("Location: " . $_SERVER['PHP_SELF'] . "?usrerror=1");
        }
    }
?>