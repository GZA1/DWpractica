<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Entity\Usuario;
use Entity\Cliente;
use Entity\Empleado;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
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
        if( $request->query->has('error') && $request->query->get('error')==1 ) {   // $_GET['error']
            $message = "Usuario no existe";
        }
        if( $request->query->has('error') && $request->query->get('error')==2 ) {   // $_GET['error']
            $message = "Contraseña incorrecta";
        }

        return $this->render('default/login.html.twig', ['msg'=>$message]);
    }

    /**
     * @Route("/login", name="login_post", methods={"POST"})
     */    
    public function loginPostAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('username'); // $_POST['username']
        $password = $request->request->get('password'); // $_POST['password']

        $user = $em->getRepository('AppBundle:Usuario')->authenticate($username, $password);
        if( $user ) {
            // Login con exito
            $session->set('is_logged', true);
            return $this->redirectToRoute('private');   // Redireccion interna
        }
        else if( $user===false ) {
            // Contraseña incorrecta
            return $this->redirectToRoute('login',['error'=>2]);
        }
        else if( $user===null ) {
            // Usuario no existe
            return $this->redirectToRoute('login',['error'=>1]);
        }        

        /*
        if( $username=='admin' && $password=='123' ) {
            // Login con exito
            $session->set('is_logged', true);
            return $this->redirectToRoute('private');   // Redireccion interna
        }
        else {
            // Login erroneo
            return $this->redirectToRoute('login',['error'=>1]);
        }
        */
    }
}
