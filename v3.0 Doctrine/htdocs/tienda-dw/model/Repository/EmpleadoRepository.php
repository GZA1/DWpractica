<?php 

namespace Repository;

use Doctrine\ORM\EntityRepository;

require_once '/xampp/appdata/model/console.php';

class EmpleadoRepository extends EntityRepository{
    
    
    // public function getEmpleadoByID($username, $passwd, $nombre, $apell, $email, $photo, $active, $cargo, $isAdministrador, $tienda_id){
        
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


<<<<<<< HEAD
<<<<<<< HEAD
    public function updatePerfilEmpleado($u, $username, $nombre, $apellidos, $photo){
        if(isset($u) && isset($username) && isset($nombre) && isset($apellidos) && isset($photo) ){
=======
    public function updatePerfilEmpleado($u, $username, $nombre, $apellidos, $photoPath){
        if(isset($u) && isset($username) && isset($nombre) && isset($apellidos) && isset($photoPath) ){
>>>>>>> parent of 02ea15f7... Merge remote-tracking branch 'origin/Gonza-Symfony' into mergeBranch
=======
    public function updatePerfilEmpleado($u, $username, $nombre, $apellidos, $photoPath){
        if(isset($u) && isset($username) && isset($nombre) && isset($apellidos) && isset($photoPath) ){
>>>>>>> parent of 02ea15f7... Merge remote-tracking branch 'origin/Gonza-Symfony' into mergeBranch
            $u  ->setUsername($username)
                ->setNombre($nombre)
                ->setApellidos($apellidos)
            ;
            $qb = $this->_em->createQueryBuilder();
            $qb ->update('Entity\\Usuario', 'u')
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
            $qb ->update('Entity\\Empleado', 'e')
<<<<<<< HEAD
<<<<<<< HEAD
                ->set('e.photo', ':photo')
                ->where('e.usuario = :u')
                ->setParameter('photo', $photo)
=======
                ->set('e.photoPath', ':photop')
                ->where('e.usuario = :u')
                ->setParameter('photop', $photoPath)
>>>>>>> parent of 02ea15f7... Merge remote-tracking branch 'origin/Gonza-Symfony' into mergeBranch
=======
                ->set('e.photoPath', ':photop')
                ->where('e.usuario = :u')
                ->setParameter('photop', $photoPath)
>>>>>>> parent of 02ea15f7... Merge remote-tracking branch 'origin/Gonza-Symfony' into mergeBranch
                ->setParameter('u', $u);
            $res = $qb->getQuery()->getResult();
            console_log($res);
            return true;
        } else{
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
            $qb ->update('Entity\\Empleado', 'e')
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
