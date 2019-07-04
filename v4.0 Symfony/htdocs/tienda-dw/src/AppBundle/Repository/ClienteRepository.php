<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class ClienteRepository extends EntityRepository
{

    public function findByUser($usuario){
        return $this->findOneBy(array("usuario" => $usuario));
    }

    public function updatePerfilCliente($u, $username, $nombre, $apellidos, $domicilio){
        if(isset($u) && isset($username) && isset($nombre) && isset($apellidos) ){
            $c = $this->findByUser($u);
            $u  ->setUsername($username)
                ->setNombre($nombre)
                ->setApellidos($apellidos)
            ;
            $c->setDomicilio($domicilio);
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Usuario', 'u')
                ->set('u.username', ':username')
                ->set('u.nombre', ':nombre')
                ->set('u.apellidos', ':apell')
                ->where('u.idUsuario = :u')
                ->setParameter('username', $username)
                ->setParameter('nombre', $nombre)
                ->setParameter('apell', $apellidos)
                ->setParameter('u', $u);
            $res = $qb->getQuery()->getResult();
            console_log($res);
            $qb = $this->_em->createQueryBuilder();
            if(isset($domicilio)){
                $qb ->update('AppBundle\\Entity\\Cliente', 'c')
                    ->set('c.domicilio', ':domic')
                    ->where('c.usuario = :u')
                    ->setParameter('domic', $domicilio)
                    ->setParameter('u', $u);
                $res = $qb->getQuery()->getResult();
                console_log($res);
            }
            return $u;
        } else{
            return false;
        }
    }


    /** 
     * Funciona igual
     * 
     */
    /*
    public function doIDexist($id){
        $em = GetEntityManager();
        $DQL = "SELECT count(c.id) FROM Cliente c WHERE c.id = :ID";
        $query = $em->createQuery($DQL);
        $query->setParameters('ID', $id);
        $resultado = $query->getResult();
        if($resultado > 0){
            return true;
        }else{
            return false;
        }
    }
    */
    public function doIDexist($id){
        $resultado = $this->findBy(['id'=>$id]);
        if(sizeof($resultado) > 0){
            return true;

        }else{
            return false;
        }
        // if(!is_null($resultado )){
        //     return true;
        //     echo "ZI";
        // }else{
        //     return false;
        //     echo "NO";
        // }
    }

/** Firma previa  - public function get_all()
 * Funcionan igual
 */
/*
    public function get_all()
    {
        $DQL = "select * from Entities\\Cliente";
        $query = $this->$em->createQuery($DQL);
        return $query->getResult();
    }
*/

public function get_all()
{
    $resultado = $this->findAll();
    return $resultado;
}
/** Firma previa - public function getPedidos()
 *  funciona igual
 */
/*
    public function getPedidos()
    {
        $DQL ="select * from Entities\\Pedido, Entities\\Cesta where Cliente_id = :id, ";
        $query = $this->$em->createQuery();
        $query->setParameters('id', $id);
        return $query->getResult();
    }
*/
/** firma previa -   private function getDataClienteId() 
 * Antes cargaba con datos la instancia Cliente que existia
 * Ahora devuelve un obj Cliente
*/
/*
    private function getDataClienteId($id){

        $DQL = "select * from Entities\\Clientes where id = :id"; 
        $query->setParameters('id', $id);

        return $query->getResult();
    }
*/

private function getDataClienteId($id){

    $resultado = $this->findOneBy(['id'=>$id]);

    return $resultado;
}
/** Firma previa -  public function updatePerfilCliente($username, $name, $surnames, $address)
 * Antes no pedia el $id como parámetro (ID del usuario logueado)
 * Devuelven lo mismo
 */
/*
    public function updatePerfilCliente($id, $username, $name, $surnames, $address)  {
        if(isset($username) & isset($name) && isset($surnames) && isset($address)){
            
        $consulta = "update Cliente set username = :Username, nombre = :Nombre, apellidos = :Apellidos, domicilio = :Domicilio WHERE id = :id";
        $query->setParameters(array(
                                'id' => $id,
                                'Username' => $username,
                                'Nombre' => $name,
                                'Apellidos' => $surnames,
                                'Domicilio' => $address
                            ));                                    
         return true;   
        }else{
            return false;
        }
    }
    
*/



}

?>