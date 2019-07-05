<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use AppBundle\Entity\Producto;



class ProductoController extends Controller
{
/**
     * @Route("/catalogoIndex", name="catalogoIndex", methods={"GET"})
     */ 

    public function catIndexAction(Request $request)
    {
        
        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();
        $categoriaRep = $em->getRepository("AppBundle\\Entity\\Categoria");
        $categorias = $categoriaRep->findAll();
        

        
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==1 ) {   // $_GET['error']
            $message = "Saldo añadido con éxito";
            $tipoMessage = 1;
        }
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==0 ) {   // $_GET['error']
            $message = "No se pudo añadir saldo correctamente";
            $tipoMessage = 0;
        }
       
        return $this->render('catalogo/catalogoIndex.html.twig', [  'msg'=>$message, 
                                                            'tipoMessage'=> $tipoMessage, 
                                                            'categorias'=> $categorias]
                                                        );
    }


    /**
     * @Route("/catalogoIndex", name="catalogoIndex_post", methods={"POST"})
     */ 
    public function catIndexPostAction(SessionInterface $session)
    {
        if( $session->get('user') != null){
            $clienteRep = $em->getRepository("AppBundle\\Entity\\Cliente");
            $cli = $empleadoRep->findOneBy($session->get('user')->getUsuario()->getUsername());
        }

        
        $saldoAdd = $_POST['saldo-add'];
        if( is_numeric($saldoAdd) && $saldoAdd > 0 && $cli->addSaldo($saldoAdd) ){
            return $this->redirectToRoute('homepage', ['saldoadd'=>1]);
        }else{
            return $this->redirectToRoute('homepage', ['saldoadd'=>0]);
        }

        
    }


    /**
     * @Route("/xxx-cat/{categoria}", name="xxx-cat", methods={"GET"}, requirements={"categoria"="\d+"}))
     */ 
    public function xxxCatAction(Request $request, SessionInterface $session, $categoria = null)
    {
        
        
        
        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();
        $productoRep = $em->getRepository("AppBundle\\Entity\\Producto");
        $categoriaRep = $em->getRepository("AppBundle\\Entity\\Categoria");
        
        $cat = null;
        if($categoria != null){            
            $cat = $categoriaRep->findOneBy(['id'=> $categoria]);
            $productos = $productoRep->findBy(['categoria'=> $categoria]);
            
        }

        
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==1 ) {   // $_GET['error']
            $message = "Saldo añadido con éxito";
            $tipoMessage = 1;
        }
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==0 ) {   // $_GET['error']
            $message = "No se pudo añadir saldo correctamente";
            $tipoMessage = 0;
        }
       
        return $this->render('catalogo/xxx-cat.html.twig', [  'msg'=> $message, 
                                                            'tipoMessage'=> $tipoMessage,
                                                            'productos'=> $productos,
                                                            'cat'=>$cat]
                                                        );

        
    }


    /**
     * @Route("/xxx-cat", name="xxx-cat_post", methods={"POST"})
     */ 
    public function xxxCatPostAction(SessionInterface $session)
    {
        
        
        
        if( $session->get('user') != null){
            $clienteRep = $em->getRepository("AppBundle\\Entity\\Cliente");
            $cli = $empleadoRep->findOneBy('username', $session->get('user')->getUsuario()->getUsername());
        }

        
        $saldoAdd = $_POST['saldo-add'];
        if( is_numeric($saldoAdd) && $saldoAdd > 0 && $cli->addSaldo($saldoAdd) ){
            return $this->redirectToRoute('homepage', ['saldoadd'=>1]);
        }else{
            return $this->redirectToRoute('homepage', ['saldoadd'=>0]);
        }

        
    }

    /**
     * @Route("/producto/{producto}", name="producto", methods={"GET"}, requirements={"producto"="\d+"}))
     */
    public function productoAction(Request $request, SessionInterface $session, $producto = null)
    {
        
        
        
        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();
        $productoRep = $em->getRepository("AppBundle\\Entity\\Producto");
        
        $stockRepo = $em->getRepository("Entity\\Unidad");
        $tiendasRepo = $em->getRepository("Entity\\Tienda");
        $prod = null;
        if($producto != null){

            $prod = $productoRep->findOneBy('id', $producto);
            $unidades = $stockRepo->findBy(['producto'=>$prod->getId()]);
        }        
        
        

        
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==1 ) {   // $_GET['error']
            $message = "Saldo añadido con éxito";
            $tipoMessage = 1;
        }
        if( $request->query->has('saldoadd') && $request->query->get('saldoadd')==0 ) {   // $_GET['error']
            $message = "No se pudo añadir saldo correctamente";
            $tipoMessage = 0;
        }
       
        return $this->render('catalogo/producto.html.twig', [  'msg'=> $message, 
                                                            'tipoMessage'=> $tipoMessage,
                                                            'prod'=> $prod,
                                                            'stock'=> $unidades]
                                                        );

        
    }

}