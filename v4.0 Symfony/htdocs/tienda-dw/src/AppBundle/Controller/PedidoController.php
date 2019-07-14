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
use AppBundle\Entity\Pedido;
use AppBundle\Entity\Producto;


class PedidoController extends Controller
{
   


    
    /**
     * @Route("/pedidos", name="pedidos", methods={"GET"})
     */
    public function pedidosAction(Request $request, SessionInterface $session)
    {

        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();

        $pedidoRep = $em->getRepository("AppBundle\\Entity\\Pedido");
        $cestaRep = $em->getRepository("AppBundle\\Entity\\Cesta");
        $pedidos=null;

        $cli = $session->get('user');
        if( !is_null($cli) ){
            $pedidos = $pedidoRep->findBy(['cesta' => $cestaRep->findBy(['cliente'=>$cli])]);
        }

        console_log($pedidos);
        console_log((array)$pedidos[0]);
        




        return $this->render('usuario/historialPedidos.html.twig', [    'msg'           => $message,
                                                                        'tipoMessage'   => $tipoMessage,
                                                                        'pedidos'       => $pedidos
                                                                    ]);


    }



}
