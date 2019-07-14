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

        // $session->set('cesta', null);

        $cesta = $session->get('cesta');

        // $arrayProductos = null;

        // if($miCesta != null){
        //     foreach($miCesta->getUnidades() as $unit){
        //         if($arrayProductos == null){
        //             $arrayProductos = array($unit);
        //         }else{
        //             if(!in_array($unit , $unit->getProducto())){
        //                 array_push($arrayProductos, $unit);
        //             }
        //         }
        //     }
        // }

        // $prod = array();

        // foreach($cesta->getUnidades() as $u){
        //     $prod[sizeof($prod)] = $u->getProducto();
        //     for($i=0;$i<sizeof($prod);$i++){
        //         $prod[$i] = $u->getProducto();
        //     }
        // }


        if(!is_null($session->get('cesta'))){

            
            console_log('Cesta');
            console_log((array)$session->get('cesta'));
            console_log('Unidades de la cesta');
            console_log((array)$session->get('cesta')->getUnidades());
            console_log('Unidad 1 de la cesta');
            console_log((array)$session->get('cesta')->getUnidades()[0]);
            console_log('Producto de la unidad 1 de la cesta');
            console_log((array)$session->get('cesta')->getUnidades()[0]->getProducto());
            console_log('Categoría del producto de la unidad 1 de la cesta');
            console_log((array)$session->get('cesta')->getUnidades()[0]->getProducto()->getCategoria());
            
        }





        return $this->render('cesta_compra/cesta.html.twig', [  'msg'=> $message,
                                                            'tipoMessage'=> $tipoMessage]
                                                        );


    }

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
