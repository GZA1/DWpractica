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


     /**
     * @Route("/tramitarPedido", name="tramitarPedido", methods={"GET"})
     */
    public function tramitarPedidosAction(Request $request, SessionInterface $session)
    {
        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();


        $cestaRep = $em->getRepository("AppBundle\\Entity\\Cesta");



        $miCesta = $session->get('cesta');
        $cesta=null;
        if( !is_null($miCesta) ){
            $cesta = $cestaRep->findOneBy(['id'=>$miCesta->getId()]);

        }


        return $this->render('cesta_compra/tramitarPedido.html.twig', [  'msg'=> $message,
                                                                        'tipoMessage'=> $tipoMessage,
                                                                        'cesta'=>$cesta]
                                                                    );
    }

     /**
     * @Route("/tramitarPedido", name="tramitarPedido_post", methods={"POST"})
     */
    public function tramitarPedidoPostAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        $cestaRep = $em->getRepository("AppBundle\\Entity\\Cesta");
        $pedidoRep = $em->getRepository("AppBundle\\Entity\\Pedido");
        $cesta = $cestaRep->findOneBy(['id'=>$session->get('cesta')->getId()]);

        if(isset($_POST['submitTram'])){
            switch($_POST['submitTram']){

                case 'Si':
                    $pedido = new Pedido();
                    $pedido->setCesta($cesta);
                    $pedidoRep->tramitarPedido($pedido);
                    $session->set('cesta', null);
                    return $this->redirectToRoute('homepage', ['tramP'=>1]);
                    break;
                case 'No':
                    return $this->redirectToRoute('homepage', ['tramP'=>0]);
                    break;
                default:
                return $this->redirectToRoute('homepage', ['tramP'=>0]);
                    break;
            }
        }


    }



}
