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
    public function indexAction(Request $request, SessionInterface $session)
    {
        $message = null;
        $tipoMessage = null;

        if( $request->query->has('usrlog') && $request->query->get('usrlog')==1 ) {   // $_GET['error']
            $message = "Logueado con éxito";
            $tipoMessage = 1;
        }
        if( $request->query->has('usrlog') && $request->query->get('usrlog')==0 ) {   // $_GET['error']
            $message = "Sesión cerrada";
            $tipoMessage = 1;
        }
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==1 ) {   // $_GET['error']
            $message = "Saldo añadido con éxito";
            $tipoMessage = 1;
        }
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==0 ) {   // $_GET['error']
            $message = "No se pudo añadir saldo correctamente";
            $tipoMessage = 0;
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

        

        return $this->render('main/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'msg'=> $message,
            'tipoMessage'=> $tipoMessage,
        ]);
    }

    /**
     * @Route("/privacyPolicy", name="privacyPolicy", methods={"GET"})
     */    
    public function privacyPolicyAction(Request $request){
        return $this->render('main/privacy-policy.html.twig');
    }



}
