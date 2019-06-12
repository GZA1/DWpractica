<?php
    require_once("dbconfig.php");
    require_once('/xampp/appdata/model/console.php');

    use Entity\Usuario;

    $em = GetEntityManager();

    echo "hola";
?>

<html>
<body>
<form method="post" id="formTest">
    <label>Username</label>
    <input type="text" id="login" name="login">
    <label>Passwd</label>
    <input type="password" id="passwd" name="passwd">
</form>
<?php
    if( $_SERVER['REQUEST_METHOD']=='POST') {
        try{
            $u = new Usuario();
            $u  ->setUsername($_POST['login'])
                ->setPasswd($_POST['passwd']);
            $u->encryptPasswd();
            if( $em->getRepository("Entity\\Usuario")->login($u) ) {
                session_start();
                $_SESSION['id'] = $em->getRepository("Entity\\Usuario")->findId($u);
                $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                console_log($_SESSION['id']);
                cLog($_SESSION['id']);
                header('Location: ../main/index.php?usrlog=1');
                exit;
            }
            else {
                header("Location: " . $_SERVER['PHP_SELF'] . "?usrerror=1");
            }
        } catch(Exception $e){echo $e;}

?>
</body>
</html>