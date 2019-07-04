<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

use AppBundle\Entity\Usuario;


require_once '/xampp/appdata/model/console.php';

class EmpleadoRepository extends EntityRepository{
    


    public function getEmpleadoByID($id){
            $resultado = $this->findBy(['id'=>$id]);
            return $resultado;        
    }

    public function findByUser($usuario){
        return $this->findOneBy(array("usuario" => $usuario));
    }


    public function updatePerfilEmpleado($u, $username, $nombre, $apellidos, $photo){
        if(isset($u) && isset($username) && isset($nombre) && isset($apellidos) ){
            $u  ->setUsername($username)
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
                ->setParameter('u', $u);
            $res = $qb->getQuery()->getResult();
            console_log($res);
            $qb = $this->_em->createQueryBuilder();
            if($photo !== ''){
                $photo='img/'.$photo;
            }
            $qb ->update('AppBundle\\Entity\\Empleado', 'e')
                ->set('e.photo', ':photo')
                ->where('e.usuario = :u')
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

    public function registrarEmpleado($e){
        if(isset($e)){
            $this->_em->persist($e);
            $this->_em->flush();
            return true;
        }
        return false;
    }
    
    public function darDeBaja($usuario){
        if(isset($usuario)){
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('AppBundle\\Entity\\Empleado', 'e')
                ->set('e.activo', ':activo')
                ->where('e.usuario = :u')
                ->setParameter('activo', '0')
                ->setParameter('u', $usuario);
            $res = $qb->getQuery()->getResult();
            return true;
        }else{
            return false;
        }
    }

}

?>
