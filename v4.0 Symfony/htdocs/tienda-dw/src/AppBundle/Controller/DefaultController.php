<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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


}
