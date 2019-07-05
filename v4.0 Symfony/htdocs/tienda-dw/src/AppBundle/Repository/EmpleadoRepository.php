<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

use AppBundle\Entity\Usuario;


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
        return $this->findOneBy(array("usuario" => $usuario));
    }


    public function updatePerfilEmpleado($u, $username, $nombre, $apellidos, $photo){
        if(isset($u) && isset($username) && isset($nombre) && isset($apellidos) ){
            $u  ->getUsuario()
                ->setUsername($username)
                ->setNombre($nombre)
                ->setApellidos($apellidos)
            ;
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Usuario', 'u')
                ->set('u.username', ':username')
                ->set('u.nombre', ':nombre')
                ->set('u.apellidos', ':apell')
                ->where('u.idUsuario = :u')
                ->setParameter('username', $username)
                ->setParameter('nombre', $nombre)
                ->setParameter('apell', $apellidos)
                ->setParameter('u', $u->getUsuario());
            $res = $qb->getQuery()->getResult();
            console_log($res);
            $qb = $this->_em->createQueryBuilder();
            if($photo !== ''){
                $photo='img/'.$photo;
            }
            $u ->setPhoto($photo);
            $qb ->update('AppBundle\\Entity\\Empleado', 'e')
                ->set('e.photo', ':photo')
                ->where('e.id = :u')
                ->setParameter('photo', $photo)
                ->setParameter('u', $u);
            $res = $qb->getQuery()->getResult();
            console_log($res);
            return true;
        } else{
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


<<<<<<< HEAD

    public function findActivos(){
        $qb = $this->_em->createQueryBuilder();
        $qb ->select('e')
            ->from('AppBundle\\Entity\\Empleado', 'e')
            ->where('e.activo = :act')
            ->setParameter('act', 1);
        $res = $qb->getQuery()->getResult();
        return $res;
    }
=======
>>>>>>> parent of 02ea15f7... Merge remote-tracking branch 'origin/Gonza-Symfony' into mergeBranch

}

?>
