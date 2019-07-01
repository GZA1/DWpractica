<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Table("usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */

class Usuario
{
    /**
     * @ORM\Id
     * @ORM\Column(name="idUsuario",type="integer", nullable=false)
     * @ORM\GeneratedValue
    */
    private $idUsuario;
    /**
     * @ORM\Column(name="username",length=45, nullable=false, unique=true)
    */
    private $username;
    /**
     * @ORM\Column(name="passwd",length=45, nullable=false)
    */
    private $passwd;
    /**
     * @ORM\Column(name="nombre",length=45, nullable=false)
    */
    private $nombre;
    /**
     * @ORM\Column(name="apellidos",length=45, nullable=false)
    */
    private $apellidos;
    /**
     * @ORM\Column(name="email",length=45, nullable=false, unique=true)
    */
    private $email;
    /**
     * @ORM\Column(name="tipo",length=12, nullable=false)
    */
    private $tipo;
    /**
     * @ORM\Column(name="fechaCreacion",type="datetime", nullable=false)
     * @ORM\GeneratedValue
     */
    private $fechaCreacion;
    /**
     * @ORM\Column(name="fechaModificacion",type="datetime", nullable=false)
     * @ORM\GeneratedValue
     */
    private $fechaModificacion;




    public function __construct(){
        $this->fechaCreacion = new \DateTime();
        $this->fechaModificacion = new \DateTime();
    }


    /** GETTERS & SETTERS */



    /**
     * Get the value of idUsuario
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set the value of idUsuario
     *
     * @return  self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of passwd
     *
     * @return  self
     */
    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;

        return $this;
    }

    /**
     * Get the value of passwd
     */
    public function getPasswd()
    {
        return $this->passwd;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of fechaCreacion
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Get the value of fechaModificacion
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Encrypt the password
     *
     * @return  self
     */
    public function encryptPasswd()
    {
        $this->passwd = sha1($this->passwd); //Hasheamos la contraseña del usuario

        return $this;
    }

}
?>
