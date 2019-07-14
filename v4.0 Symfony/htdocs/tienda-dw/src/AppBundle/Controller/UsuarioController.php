<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Psr\Log\LoggerInterface;

use AppBundle\Entity\Usuario;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Empleado;
use AppBundle\Entity\Tienda;
use AppBundle\Entity\Cesta;


class UsuarioController extends Controller
{

    /**
     * @Route("/login", name="login", methods={"GET"})
     */    
    public function loginAction(Request $request)
    {
        $message = null;
        $tipoMessage = null;
        if( $request->query->has('usrreg') && $request->query->get('usrreg')==1 ) {   // $_GET['error']
            $message = "Usuario registrado con éxito, proceda a loguearse";
            $tipoMessage = 1;

        }
        if( $request->query->has('usrerror') && $request->query->get('usrerror')==1 ) {   // $_GET['error']
            $message = "Usuario o contraseña incorrectos";
            $tipoMessage = 0;
        }
        
        

        return $this->render('usuario/login.html.twig', ['msg'=>$message,
                            'tipoMessage'=>$tipoMessage]);
    }

    /**
     * @Route("/login", name="login_post", methods={"POST"})
     */    
    public function loginPostAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();

        $u = new Usuario();
        
        $usuarioRep = $em->getRepository("AppBundle\\Entity\\Usuario");


        if( preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $_POST['login']) ){
            $u->setEmail($request->request->get('login'));
        } else{
            $u->setUsername($request->request->get('login'));
        }
        $u->setPasswd($request->request->get('passwd'));
        $u->encryptPasswd();

        if( ! is_null($u = $usuarioRep->login($u)) ) {
            $tipoLogueado = $u->getTipo();
            if($u->getTipo() == "empleado"){
                $empRep = $em->getRepository("AppBundle\\Entity\\Empleado");
                $u = $empRep->findByUser($u);
                if( $u->getIsAdministrador() ){
                    $tipoLogueado = "admin";
                }

            }else{
                $cliRep = $em->getRepository("AppBundle\\Entity\\Cliente");
                $u = $cliRep->findByUser($u);
            }
            
            $session->set('user', $u);
            $session->set('tipo', $tipoLogueado);
            //$sesion->set('ip', $request->request->getClientIp());
            
           // cLog("IdUsuario logueado: " . $_SESSION['user']->getIdUsuario());
        //    $logger->info('IdUsuario logueado:', ['usuario'=>$u->getUsuario()->getUsername()]);
           return $this->redirectToRoute('homepage', ['usrlog'=>1]);            
            
        }
        else {
            return $this->redirectToRoute('login', ['usrerror'=>1]);
            
        }

    }


    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */    
    public function logoutAction(Request $request, SessionInterface $session)
    {
        $session->invalidate();

        return $this->redirectToRoute('homepage', ['usrlog'=>0]);
    }

    /**
     * @Route("/signUp", name="signUp", methods={"GET"})
     */    
    public function signUpAction(Request $request)
    {
        $message = null;
        if( $request->query->has('usrreg') && $request->query->get('usrreg')==0 ) {   // $_GET['error']
            $message = "Nombre de usuario o email inválido";
        }        

        return $this->render('usuario/sign-up.html.twig', ['msg'=>$message]);
    }


    /**
     * @Route("/signUp", name="signUp_post", methods={"POST"})
     */    
    public function signUpPostAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $u = new Usuario();
        $c = new Cliente();
        $usuarioRep = $em->getRepository("AppBundle\\Entity\\Usuario");
        $clienteRep = $em->getRepository("AppBundle\\Entity\\Cliente");
        $ubicRep = $em->getRepository("AppBundle\\Entity\\Ubicacion");

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
            
            if( $usuarioRep->existsUsername($u->getUsername()) ||
            $usuarioRep->existsEmail($u->getEmail())){
                
                return $this->redirectToRoute('signUp', ['usrreg'=>0]);
            }
            
        $em->persist($u);
        $em->flush();

        $c  ->setDomicilio($_POST['domicilio'])
            ->setUsuario($usuarioRep->findByUsername($u->getUsername()))
            ->setUbicacion($ubicRep->findByMunic($munic));

        console_log((array)$c);
        $em->persist($c);
        $em->flush();

        
        return $this->redirectToRoute('login', ['usrreg'=>1]);

    }



    /**
     * @Route("/perfil", name="perfil", methods={"GET"})
     */    
    public function perfilAction(Request $request, SessionInterface $session)
    {
        $message = null;
        $tipoMessage = null;


        if( $request->query->has('updateProfile') && $request->query->get('updateProfile')==1 ) {
            $tipoMessage = 1; //color: #2fbf2f
            $message = "Perfil Actualizado";
        }        
        if( $request->query->has('passwdchange') && $request->query->get('passwdchange')==0 ) {   
            $message = "No se pudo cambiar la contraseña";
            $tipoMessage = 0; //color: #ff7f7f
        }        
        if( $request->query->has('passwdchange') && $request->query->get('passwdchange')==1 ) {   
            $message = "Contraseña modificada con éxito";
            $tipoMessage = 1;
        }        
        if( $request->query->has('confirmpasswd') && $request->query->get('confirmpasswd')==0 ) {   
            $message = "Contraseña de confirmación incorrecta";
            $tipoMessage = 0; 
        }        
        if( $request->query->has('opfallida') && $request->query->get('opfallida')==1 ) {   
            $message = "Operación fallida";
            $tipoMessage = 0; 
        }    
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==1 ) {   // $_GET['error']
            $message = "Saldo añadido con éxito";
            $tipoMessage = 1;
        }
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==0 ) {   // $_GET['error']
            $message = "No se pudo añadir saldo correctamente";
            $tipoMessage = 0;
        }    

        return $this->render('usuario/perfil.html.twig', ['msg'=>$message, 'tipoMessage'=> $tipoMessage]);
    }
    
    /**
     * @Route("/perfil", name="perfil_post", methods={"POST"})
     */    
    public function perfilPostAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        
        $usuarioRep = $em->getRepository("AppBundle\\Entity\\Usuario");
        $clienteRep = $em->getRepository("AppBundle\\Entity\\Cliente");
        $empleadoRep = $em->getRepository("AppBundle\\Entity\\Empleado");

        $u = $session->get('user');

        if(isset($_POST['optsSubmit'])){
            switch($_POST['optsSubmit']){
                
                case 'Actualizar Perfil':
                    if( $u->getUsuario()->getPasswd() == sha1($_POST['ContraseñaConfirm']) ){

                        if( $session->get('tipo') == "cliente"  && ( ! $usuarioRep->existsUsername($_POST['Username']) || $_POST['Username'] == $u->getUsuario()->getUsername() )
                            && $clienteRep->updatePerfilCliente($u, $_POST['Username'], $_POST['Nombre'], $_POST['Apellidos'], $_POST['Domicilio']) ){
                            
                            return $this->redirectToRoute('perfil', ['updateProfile'=>1]);

                        }else if( ($session->get('tipo') == "empleado" || $session->get('tipo') == "admin") && ( ! $usuarioRep->existsUsername($_POST['Username']) || $_POST['Username'] == $u->getUsuario()->getUsername() )
                            && $empleadoRep->updatePerfilEmpleado($u, $_POST['Username'], $_POST['Nombre'], $_POST['Apellidos'], $_FILES['photo']['name']) ){

                            return $this->redirectToRoute('perfil', ['updateProfile'=>1]);

                        }else{                        
                            return $this->redirectToRoute('perfil', ['opfallida'=>1]);                        
                        }
                    }else{
                        return $this->redirectToRoute('perfil', ['confirmpasswd'=>0]);    
                    }
                break;            
                
                case 'Cambiar contraseña':

                    if( $u->getPasswd() == sha1($_POST['oldPasswd']) ){
                        if( $_POST['newPasswd'] == $_POST['newPasswd2'] && $usuarioRep->changePasswd($u, sha1($_POST['newPasswd'])) ){
                            return $this->redirectToRoute('perfil', ['passwdchange'=>1]);    
                        }else {
                            return $this->redirectToRoute('perfil', ['passwdchange'=>0]);
                        }
                    }else{
                        return $this->redirectToRoute('perfil', ['confirmpasswd'=>0]);
                    }        
                break;            
                            
            }
        }
        if( $session->get('user') != null && isset($_POST['saldo-add']) ){
            $em = $this->getDoctrine()->getManager();
            $cli = $session->get('user');
            $saldoAdd = $_POST['saldo-add'];
            $clienteRep = $em->getRepository("AppBundle\\Entity\\Cliente");
            if( is_numeric($saldoAdd) && $saldoAdd > 0 && $cli->addSaldo($saldoAdd) && $clienteRep->updateSaldo($cli) ){
                return $this->redirectToRoute($request->get('_route'), ['saldoadd'=>1]);
            }else{
                return $this->redirectToRoute($request->get('_route'), ['saldoadd'=>0]);
            }
        }

    }

    /**
     * @Route("/adminCfg", name="adminCfg", methods={"GET"})
     */    
    public function adminCfgAction(Request $request)
    {
        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();
        $tiendaRep = $em->getRepository("AppBundle\\Entity\\Tienda");
        $empleadoRep = $em->getRepository("AppBundle\\Entity\\Empleado");
        $tiendas = $tiendaRep->findAll();
        $empleados = $empleadoRep->findActivos();



        if( $request->query->has('newEmp') && $request->query->get('newEmp')==1 ) {   
            $tipoMessage = 1; //color: #2fbf2f
            $message = "Empleado Registrado";
        }        
        if( $request->query->has('opfallida') && $request->query->get('opfallida')==1 ) {   
            $message = "Operación fallida";
            $tipoMessage = 0; //color: #ff7f7f
        }        
        if( $request->query->has('newShop') && $request->query->get('newShop')==1 ) {   
            $message = "Tienda añadida";
            $tipoMessage = 1;
        }        
        if( $request->query->has('confirmpasswd') && $request->query->get('confirmpasswd')==0 ) {   
            $message = "Contraseña de confirmación incorrecta";
            $tipoMessage = 0; 
        }        
        if( $request->query->has('empDEL') && $request->query->get('empDEL')==0 ) {   
            $message = "Empleado no encontrado O ERES TÚ MISMO!";
            $tipoMessage = 0; 
        }        
        if( $request->query->has('empDEL') && $request->query->get('empDEL')==1 ) {   
            $message = "Empleado dado de baja con éxito";
            $tipoMessage = 1; 
        }        

        return $this->render('usuario/cfg.html.twig', [ 'msg'=>$message, 
                                                        'tipoMessage'=> $tipoMessage, 
                                                        'tiendas'=> $tiendas,
                                                        'empleados'=> $empleados]
                                                        );
    }
    
    /**
     * @Route("/adminCfg", name="adminCfg_post", methods={"POST"})
     */    
    public function adminCfgPostAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        $usuarioRep = $em->getRepository("AppBundle\\Entity\\Usuario");
        $tiendaRep = $em->getRepository("AppBundle\\Entity\\Tienda");
        $empleadoRep = $em->getRepository("AppBundle\\Entity\\Empleado");
        $ubicacionRep = $em->getRepository("AppBundle\\Entity\\Ubicacion");

        $u = $session->get('user')->getUsuario();

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
                                        ->setPhoto('img/'.$_FILES['photo']['name']) 
                                        ->setCargo($_POST['Cargo'])
                                        ->setTienda($tiendaSeleccionada);
                            console_log((array)$newEmpleado);
                            $empleadoRep->registrarEmpleado($newEmpleado);
                            
                            return $this->redirectToRoute('adminCfg', ['newEmp'=>1]);
                            
                        }else{
                            return $this->redirectToRoute('adminCfg', ['opfallida'=>1]);                            
                        }
                    }else{
                        return $this->redirectToRoute('adminCfg', ['confirmpasswd'=>0]);                            
                        header('Location: ?confirmpasswd=0');
                        exit;
                    }    
                    break;
                    
                    case 'Baja Empleado':
                    $usBaja = $usuarioRep->find($_POST['idBajaEmpleado']);
                    if( $usBaja != $u && $empleadoRep->darDeBaja($usBaja) ){
                        
                        return $this->redirectToRoute('adminCfg', ['empDEL'=>1]);                            
                        
                    }else{
                        
                        return $this->redirectToRoute('adminCfg', ['empDEL'=>0]);                            
                        
                    }
                    
                    break;
                    
                    case 'Añadir Tienda':
                    if( $u->getPasswd() == sha1($_POST['ContraseñaConfirm']) ){
                        $cp = $_POST['CodigoPostal'];
                        $ubic = $ubicacionRep->findOneBy(['cp'=>$cp]);
                        $newTienda = new Tienda();
                        $newTienda  ->setNombre($_POST['NombreTienda'])
                        ->setDireccion($_POST['Direccion']) 
                        ->setEmail($_POST['EmailTienda'])
                        ->setUbicacion($ubic);
                        if( isset($ubic) && $tiendaRep->registrarTienda($newTienda) ){
                            return $this->redirectToRoute('adminCfg', ['newShop'=>1]);                            

                        }else{
                            return $this->redirectToRoute('adminCfg', ['opfallida'=>1]);                            
                            
                        }
                    }else{
                        return $this->redirectToRoute('adminCfg', ['confirmpasswd'=>1]);                            
                    }
                break;
            }
        }
    }

}
