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
use AppBundle\Entity\Pedido;


class CestaController extends Controller
{
   


    
    /**
     * @Route("/cesta", name="cesta", methods={"GET"})
     */
    public function cestaAction(Request $request, SessionInterface $session)
    {

        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();

        $productoRep = $em->getRepository("AppBundle\\Entity\\Producto");
        $categoriaRepo = $em->getRepository("AppBundle\\Entity\\Categoria");
        $tiendaRepo = $em->getRepository("AppBundle\\Entity\\Tienda");
        $unidadRepo = $em->getRepository("AppBundle\\Entity\\Unidad");
        $cestaRep = $em->getRepository("AppBundle\\Entity\\Cesta");
        $productos = $productoRep->findAll();
        $categorias = $categoriaRepo->findAll();
        $tiendas = $tiendaRepo->findAll();
        $stock = $unidadRepo->findAll();

<<<<<<< HEAD
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==1 ) {   // $_GET['error']
            $message = "Saldo añadido con éxito";
            $tipoMessage = 1;
        }
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==0 ) {   // $_GET['error']
            $message = "No se pudo añadir saldo correctamente";
            $tipoMessage = 0;
        }

        // $session->set('cesta', null);
=======
        
>>>>>>> origin/#Fun2

        $miCesta = $session->get('cesta');
        $cesta=null;
        if( !is_null($miCesta) ){
            $cesta = $cestaRep->findOneBy(['id'=>$miCesta->getId()]);
            
        }


        
        if(!is_null($session->get('cesta'))){

            
            console_log('Cesta');
            console_log((array)$cesta);
            console_log('Unidades de la cesta');
            console_log((array)$cesta);
            console_log('Unidad 1 de la cesta');
            console_log($cesta->getUnidades()[0]);
            console_log('Producto de la unidad 1 de la cesta');
            console_log($cesta->getUnidades()[0]->getProducto());
            console_log('Categoría del producto de la unidad 1 de la cesta');
            console_log($cesta->getUnidades()[0]->getProducto()->getCategoria());
            
        }

        return $this->render('cesta_compra/cesta.html.twig', [  'msg'=> $message,
                                                            'tipoMessage'=> $tipoMessage,
                                                            'cesta'=>$cesta]
                                                        );


    }
  
  
    /**
     * @Route("/cesta", name="cestaPost", methods={"POST"})
     */
    public function cestaPostAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        $cli = $session->get('user');


        if( $session->get('user') != null && isset($_POST['saldo-add']) ){
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
     * @Route("/cancelarCesta", name="cancelarCesta", methods={"GET"})
     */
    public function cancelarCestaAction(Request $request, SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();        
        $cestaRepo = $em->getRepository("AppBundle\\Entity\\Cesta");
        $actualCesta = $cestaRepo->findOneBy(['id'=> $session->get('cesta')->getId()]); 
        if($cestaRepo->cancelarCesta($actualCesta)){
            $session->set('cesta', null);
        }else{
            //error
        }

        

        return $this->redirectToRoute('cesta');
    }




}
