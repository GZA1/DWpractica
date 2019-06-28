<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use AppBundle\Entity\Usuario;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Empleado;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        // return $this->render('main/index.html.twig');
        // return $this->render('main/index.html.twig');
        return $this->render('main/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/login", name="login", methods={"GET"})
     */    
    public function loginAction(Request $request)
    {
        $message = null;
        if( $request->query->has('usrreg') && $request->query->get('usrreg')==1 ) {   // $_GET['error']
            $message = "Usuario registrado con éxito, proceda a loguearse";
        }
        if( $request->query->has('usrerror') && $request->query->get('usrerror')==1 ) {   // $_GET['error']
            $message = "Usuario o contraseña incorrectos";
        }

        return $this->render('usuario/login.html.twig', ['msg'=>$message]);
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
            
            $session->set('username', $u->getUsuario()->getUsername());
            $session->set('tipo', $tipoLogueado);
            //$sesion->set('ip', $request->request->getClientIp());
            
           // cLog("IdUsuario logueado: " . $_SESSION['user']->getIdUsuario());
           return $this->redirectToRoute('homepage', ['usrlog'=>1, 'user'=>$u]);
            
            
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

        return $this->render('main/index.html.twig');
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
                
                return $this->render('usuario/sign-up.html.twig', ['usrreg'=>0]);
            }
            
        $em->persist($u);
        $em->flush();

        $c  ->setDomicilio($_POST['domicilio'])
            ->setUsuario($usuarioRep->findByUsername($u->getUsername()))
            ->setUbicacion($ubicRep->findByMunic($munic));

        console_log((array)$c);
        $em->persist($c);
        $em->flush();

        
        return $this->render('usuario/login.html.twig', ['usrreg'=>1]);

    }


}
