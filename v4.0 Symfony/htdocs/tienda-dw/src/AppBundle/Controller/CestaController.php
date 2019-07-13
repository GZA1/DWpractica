<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use AppBundle\Entity\Usuario;
use AppBundle\Entity\Cliente;
use AppBundle\Entity\Unidad;
use AppBundle\Entity\Cesta;
use AppBundle\Entity\Producto;


class CestaController extends Controller
{
    /**
     * @Route("/cancelarCesta", name="cancelarCesta", methods={"GET"})
     */
    public function cancelarCesta(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();        

        $cestaRepo = $em->getRepository("AppBundle\\Entity\\Cesta");
        $cestaRepo->cancelarCesta($session->get('cesta'));
        $session->set('cesta', null);

        

        return $this->redirectToRoute('cesta');
    }



}
