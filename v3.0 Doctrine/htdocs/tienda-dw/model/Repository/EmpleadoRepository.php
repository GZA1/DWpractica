<?php 

namespace Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class EmpleadoRepository extends EntityRepository{
    
    
    // public function getEmpleadoByID($username, $passwd, $nombre, $apell, $email, $photoPath, $active, $cargo, $isAdministrador, $tienda_id){
        
    //     $DQL = "select * from Entities\\Empleado where id = :id";
    //     //$query = -> $this ->createQuery($DQL);
    //     /**OYE ESTO NO ESTÁ HECHO JEJ */
    //     $query->setParameters('id', 'Bob');
    //     $emp = $query->$em->getResult();
    // }

    public function getEmpleadoByID($id){
            $resultado = $this->findBy(['id'=>$id]);
            return $resultado;        
    }

    public function findByUser($usuario){
        return $this->findOneBy(array("Usuario_idUsuario" => $usuario->getIdUsuario()));
    }


    /* No se si funciona, probar*/
    public function updatePerfilEmpleado($id, $username, $name, $surnames){
        if(isset($username) && isset($name) && isset($surnames)){
            $user = $this->findBy(['id'=>$id]);
            $user->setUsername($username)
                 ->setNombre($name)
                 ->setApellidos($surnames)
                 ->setDomicilio($address);
            $em->persist($user);
            $em->flush();
            
            return true;

        }else{

            return false;
        }
    }

    public function doIDexist($id){
        $resultado = $this->findBy(['id'=>$id]);
        if(sizeof($resultado) > 0){
            return true;

        }else{
            return false;
        }
    }



}

?>
