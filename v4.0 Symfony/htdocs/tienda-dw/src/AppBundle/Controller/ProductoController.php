<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


use AppBundle\Entity\Producto;
use AppBundle\Entity\Unidad;
use AppBundle\Entity\Categoria;
use AppBundle\Entity\Tienda;



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
        $em = $this->getDoctrine()->getManager();
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
        
        $em = $this->getDoctrine()->getManager();
        
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
        
        $stockRepo = $em->getRepository("AppBundle\\Entity\\Unidad");
        $tiendasRepo = $em->getRepository("AppBundle\\Entity\\Tienda");
        $prod = null;
        if($producto != null){

            $prod = $productoRep->findOneBy(['id'=> $producto]);
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




    /**
     * @Route("/cfgCatalogo", name="cfgCatalogo", methods={"GET"})
     */
    public function cfgCatalogoAction(Request $request, SessionInterface $session)
    {
        
        $message = null;
        $tipoMessage = null;
        $em = $this->getDoctrine()->getManager();

        $productoRep = $em->getRepository("AppBundle\\Entity\\Producto");        
        $categoriaRepo = $em->getRepository("AppBundle\\Entity\\Categoria");
        $tiendaRepo = $em->getRepository("AppBundle\\Entity\\Tienda");
        $unidadRepo = $em->getRepository("AppBundle\\Entity\\Unidad");
        $productos = $productoRep->findAll();
        $categorias = $categoriaRepo->findAll();
        $tiendas = $tiendaRepo->findAll();
        $stock = $unidadRepo->findAll();
               
        
        

        
        if( $request->query->has('addCat') && $request->query->get('addCat')==1 ) {   // $_GET['error']
            $message = "Categoria añadida";
            $tipoMessage = 1;
        }
        if( $request->query->has('editCat') && $request->query->get('editCat')==1 ) {   // $_GET['error']
            $message = "Categoria editada";
            $tipoMessage = 1;
        }
        if( $request->query->has('remCat') && $request->query->get('remCat')==1 ) {   // $_GET['error']
            $message = "Categoria eliminada";
            $tipoMessage = 1;
        }
        if( $request->query->has('addPr') && $request->query->get('addPr')==1 ) {   // $_GET['error']
            $message = "Producto añadido";
            $tipoMessage = 1;
        }
        if( $request->query->has('editPr') && $request->query->get('editPr')==1 ) {   // $_GET['error']
            $message = "Producto editado";
            $tipoMessage = 1;
        }
        if( $request->query->has('removePr') && $request->query->get('removePr')==1 ) {   // $_GET['error']
            $message = "Producto eliminado";
            $tipoMessage = 1;
        }
        if( $request->query->has('aumStock') && $request->query->get('aumStock')==1 ) {   // $_GET['error']
            $message = "Stock aumentado";
            $tipoMessage = 1;
        }
        if( $request->query->has('remStock') && $request->query->get('remStock')==1 ) {   // $_GET['error']
            $message = "Stock reducido";
            $tipoMessage = 1;
        }
        if( $request->query->has('transProd') && $request->query->get('transProd')==1 ) {   // $_GET['error']
            $message = "Producto transladado";
            $tipoMessage = 1;
        }
        if( $request->query->has('opfallida') && $request->query->get('opfallida')==1 ) {   // $_GET['error']
            $message = "Operación fallida";
            $tipoMessage = 0;
        }
        if( $request->query->has('opfallida') && $request->query->get('opfallida')==2 ) {   // $_GET['error']
            $message = "Todos los campos Vacios";
            $tipoMessage = 0;
        }
        
                                        
        return $this->render('catalogo/cfgCatalogo.html.twig', [  'msg'=> $message, 
                                                            'tipoMessage'=> $tipoMessage,
                                                            'categorias'=> $categorias,
                                                            'productos'=> $productos,
                                                            'tiendas'=> $tiendas,
                                                            'stock'=> $stock]
                                                        );

        
    }



    /**
     * @Route("/cfgCatalogo", name="cfgCatalogo_post", methods={"POST"})
     */ 
    public function cfgCatalogoPostAction(SessionInterface $session)
    {
        $em = $this->getDoctrine()->getManager();
        if(isset($_POST['optsSubmit2'])){
            
            switch($_POST['optsSubmit2']){

                case 'Añadir Categoria':
                    $nuevaCategoria = new Categoria();
                    $nuevaCategoria->setNombre($_POST['nombreCATAdd'])
                                    ->setAcronimo($_POST['acrCATAdd'])
                                    ->setDescripcion($_POST['descCATAdd']);
                    $em->persist($nuevaCategoria);
                    $em->flush();
                    return $this->redirectToRoute('cfgCatalogo', ['addCat'=>1]);
                    
                break;

                case 'Editar Categoria':                
                $catEdit = $em->findOneBy('acronimo', $_POST['cat_elegEdit']);
                if(isset($catEdit)){
                    if(empty($nombreCATEdit) && empty($acrCATEdit) && empty($descCATEdit)){
                        return $this->redirectToRoute('cfgCatalogo', ['opFallida'=>2]);                        
                    }else{
                        
                        if($_POST['nombreCATEdit'] != ""){
                            $catEdit->setNombre($_POST['nombreCATEdit']);
                        }                    
                        if($_POST['acrCATEdit'] != ""){
                            $catEdit->setAcronimo($_POST['acrCATEdit']);
                        }
                        if($_POST['descCATEdit'] != ""){
                            $catEdit->setDescripcion($_POST['descCATEdit']);
                        }
                    }
                    
                    $em->persist($catEdit);
                    $em->flush();
                    
                    return $this->redirectToRoute('cfgCatalogo', ['editCat'=>1]);                        
                    
                }else{
                    
                    return $this->redirectToRoute('cfgCatalogo', ['opFallida'=>1]);                        
                    
                }
                
                break;
                
                case 'Eliminar Categoria':
                
                    $catRemove = $em->findOneBy('acronimo', $_POST['cat_elegRem']);
                    $em->remove($catRemove);
                    $em->flush();
                    return $this->redirectToRoute('cfgCatalogo', ['remCat'=>1]);                        
                    
                break;

                case 'Añadir Producto':
                    $nuevoProducto = new Producto();
                    $nuevoProducto->setNombre($_POST['nombrePrNEW'])
                                    ->setMarca($_POST['marcaPrNEW'])
                                    ->setModelo($_POST['modeloPrNEW'])
                                    ->setPrecio($_POST['precioPrNEW'])
                                    ->setDescripcion($_POST['descripcionPrNEW'])
                                    ->setPicPath($_POST['picpathPrNEW']);
                    $em->persist($nuevoProducto);
                    $em->flush();
                    return $this->redirectToRoute('cfgCatalogo', ['addPr'=>1]);                        
                    
                       
                break;

                case 'Editar Producto':
                $catEdit = $em->findOneBy('acronimo', $_POST['cat_elegEdit']);
                if(isset($prEdit)){
                    if(empty($nombrePrEDIT) && empty($marcaPrEDIT) && empty($modeloPrEDIT) && empty($precioPrEDIT)
                       && empty($descPrEDIT) && empty($picpathPrEDIT)){

                        return $this->redirectToRoute('cfgCatalogo', ['opFallida'=>2]);                        

                    }else{

                        if($_POST['nombrePrEDIT'] != ""){
                            $prEdit->setNombre($_POST['nombrePrEDIT']);
                        }                    
                        if($_POST['marcaPrEDIT'] != ""){
                            $prEdit->setMarca($_POST['marcaPrEDIT']);
                        }
                        if($_POST['modeloPrEDIT'] != ""){
                            $prEdit->setModelo($_POST['modeloPrEDIT']);
                        }
                        if($_POST['precioPrEDIT'] != ""){
                            $prEdit->setPrecio($_POST['precioPrEDIT']);
                        }
                        if($_POST['descPrEDIT'] != ""){
                            $prEdit->setDescripcion($_POST['descPrEDIT']);
                        }
                        if($_POST['picpathPrEDIT'] != ""){
                            $prEdit->setPicPath($_POST['picpathPrEDIT']);
                        }
                        
                        $em->persist($prEdit);
                        $em->flush();
                        return $this->redirectToRoute('cfgCatalogo', ['editPr'=>1]);
                        
                    }
                    }else{
                        return $this->redirectToRoute('cfgCatalogo', ['opfallida'=>1]);
                    
                }
                
                break;

                case 'Eliminar Producto':
                    $prRemove = $em->findOneBy('nombre', $_POST['pr_elegRemove']);
                    $em->remove($prRemove);
                    $em->flush();
                    return $this->redirectToRoute('cfgCatalogo', ['removePr'=>1]);
                break;

                case 'Aumentar stock';
                    $unit = new Unidad();
                    $unit->setProducto($_POST['prToAumStock'])
                            ->setTienda($_POST['tiendaElegidaUP']);
                    for($i=0; i<$_POST['stockUPvalue']; $i++){
                        $em->persist($unit);
                        $em->flush();
                    }
                    return $this->redirectToRoute('cfgCatalogo', ['aumStock'=>1]);
                        

                break;

                case 'Reducir stock';
                    $unit = new Unidad();
                    $unit->setProducto($_POST['prToRemStock'])
                            ->setTienda($_POST['tiendaElegidaDOWN']);
                    for($i=0; i<$_POST['stockDOWNvalue']; $i++){
                        $em->remove($unit);
                        $em->flush();
                    }
                    return $this->redirectToRoute('cfgCatalogo', ['remStock'=>1]);
                        
                    
                break;
                
                case 'Transladar producto';
                    $unitT = new Unidad();
                    $unitT->setProducto($_POST['prToTrans'])
                            ->setTienda($_POST['prodTransValue']);
                    $unitR->setProducto($_POST['prToTrans'])
                            ->setTienda($_POST['prodTransValue']);

                    for($i=0; i<$_POST['prodTransValue']; $i++){
                        $em->remove($unitR);
                        $em->flush();
                        $em->persist($unitT);
                        $em->flush();
                    }
                    return $this->redirectToRoute('cfgCatalogo', ['transProd'=>1]);
                    
                break;
            }
        }
        
        

        
    }


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
        $productos = $productoRep->findAll();
        $categorias = $categoriaRepo->findAll();
        $tiendas = $tiendaRepo->findAll();
        $stock = $unidadRepo->findAll();
               
        
        

        
        if( $request->query->has('addCat') && $request->query->get('addCat')==1 ) {   // $_GET['error']
            $message = "Categoria añadida";
            $tipoMessage = 1;
        }
        if( $request->query->has('editCat') && $request->query->get('editCat')==1 ) {   // $_GET['error']
            $message = "Categoria editada";
            $tipoMessage = 1;
        }
        if( $request->query->has('remCat') && $request->query->get('remCat')==1 ) {   // $_GET['error']
            $message = "Categoria eliminada";
            $tipoMessage = 1;
        }
        if( $request->query->has('addPr') && $request->query->get('addPr')==1 ) {   // $_GET['error']
            $message = "Producto añadido";
            $tipoMessage = 1;
        }
        if( $request->query->has('editPr') && $request->query->get('editPr')==1 ) {   // $_GET['error']
            $message = "Producto editado";
            $tipoMessage = 1;
        }
        if( $request->query->has('removePr') && $request->query->get('removePr')==1 ) {   // $_GET['error']
            $message = "Producto eliminado";
            $tipoMessage = 1;
        }
        if( $request->query->has('aumStock') && $request->query->get('aumStock')==1 ) {   // $_GET['error']
            $message = "Stock aumentado";
            $tipoMessage = 1;
        }
        if( $request->query->has('remStock') && $request->query->get('remStock')==1 ) {   // $_GET['error']
            $message = "Stock reducido";
            $tipoMessage = 1;
        }
        if( $request->query->has('transProd') && $request->query->get('transProd')==1 ) {   // $_GET['error']
            $message = "Producto transladado";
            $tipoMessage = 1;
        }
        if( $request->query->has('opfallida') && $request->query->get('opfallida')==1 ) {   // $_GET['error']
            $message = "Operación fallida";
            $tipoMessage = 0;
        }
        if( $request->query->has('opfallida') && $request->query->get('opfallida')==2 ) {   // $_GET['error']
            $message = "Todos los campos Vacios";
            $tipoMessage = 0;
        }
        
                                        
        return $this->render('cesta_compra/cesta.html.twig', [  'msg'=> $message, 
                                                            'tipoMessage'=> $tipoMessage,
                                                            'categorias'=> $categorias,
                                                            'productos'=> $productos,
                                                            'tiendas'=> $tiendas,
                                                            'stock'=> $stock]
                                                        );

        
    }


}
