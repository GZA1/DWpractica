<?php 

namespace Repository;


use Doctrine\ORM\EntityRepository;

class ClienteRepository extends EntityRepository
{

    public function add($cliente) {

    }

    /** Funciona igual
     * 
     */
    public function doIDexist($id){
        $DQL = "select count(*) from Entities\\Empleado where id = :ID";
        $query = $this->$em->createQuery($DQL);
        $query->setParameters('ID', $id);
        $resultado = $query->getResult();
        if($resultado > 0){
            return true;
        }else{
            return false;
        }
    }

/** Firma previa  - public function get_all()
 * Funcionan igual
 */
    public function get_all()
    {
        $DQL = "select * from Entities\\Clientes";
        $query = $this->$em->createQuery($DQL);
        return $query->getResult();
    }
/** Firma previa - public function getPedidos()
 *  funciona igual
 */
    public function getPedidos()
    {
        $DQL ="select * from Entities\\Pedido, Entities\\Cesta where Cliente_id = :id, ";
        $query = $this->$em->createQuery();
        $query->setParameters('id', $id);
        return $query->getResult();
    }

/** firma previa -   private function getDataClienteId() 
 * Antes cargaba con datos la instancia Cliente que existia
 * Ahora devuelve un obj Cliente
*/
    private function getDataClienteId($id){

        $DQL = "select * from Entities/Cliente where id = :id"; 
        $query->setParameters('id', $id);
        return $query->getResult();
    }

/** Firma previa -  public function updatePerfilCliente($username, $name, $surnames, $address)
 * Antes no pedia el $id como parámetro (ID del usuario logueado)
 * Devuelven lo mismo
 */

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
   
    




}

?>