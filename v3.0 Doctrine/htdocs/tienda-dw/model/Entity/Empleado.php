<?php

namespace Entity;

/**
 * @Table("empleado")
 * @Entity(repositoryClass="Repository\EmpleadoRepository")
 */

class Empleado
{
    /** 
     * @Id
     * @Column(name="id",length=45, nullable=false, unique=true)
     * @GeneratedColumn(strategy="NONE")
    */
    private $id;
    /** 
     * @Column(name="photoPath",length=45, nullable=true)
     */
    private $photoPath;
    /** 
     * @Column(name="activo",type="boolean", nullable=false)
     */
    private $activo;
    /** 
     * @Column(name="cargo",length=45, nullable=false)
     */
    private $cargo;
    /**
     *  @Column(name="isAdministrador",type="boolean", nullable=false)
     */
    private $isAdministrador;
    
    /*                      F O R E I G N   K E Y S
    */

    /** 
     * Un empleado trabaja en una tienda
     * @ManyToOne(targetEntity="Tienda", inversedBy="empleados") 
     * @JoinColumn(name="Tienda_id", referencedColumnName="id")
     */
    private $tienda;
    /**
     * Un cliente tiene un usuario asociado
     * @OneToOne(targetEntity="Usuario")
     * @JoinColumn(name="Usuario_idUsuario", referencedColumnName="idUsuario")
     */
    private $usuario;




    public function __construct(){
        $this->generateId();
        $this->activo = 1;
        $this->isAdministrador = 0;
        console_log((array)$this);
    }



    
    /** GETTERS & SETTERS */



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of photoPath
     */ 
    public function getPhotoPath()
    {
        return $this->photoPath;
    }

    /**
     * Set the value of photoPath
     *
     * @return  self
     */ 
    public function setPhotoPath($photoPath)
    {
        $this->photoPath = $photoPath;

        return $this;
    }

    
    /**
     * Get the value of activo
     */ 
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set the value of activo
     *
     * @return  self
     */ 
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get the value of cargo
     */ 
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set the value of cargo
     *
     * @return  self
     */ 
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get the value of isAdministrador
     */ 
    public function getIsAdministrador()
    {
        return $this->isAdministrador;
    }

    /**
     * Set the value of isAdministrador
     *
     * @return  self
     */ 
    public function setIsAdministrador($isAdministrador)
    {
        $this->isAdministrador = $isAdministrador;

        return $this;
    }

    /**
     * Get un empleado trabaja en una tienda
     */ 
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Set un empleado trabaja en una tienda
     *
     * @return  self
     */ 
    public function setTienda($tienda)
    {
        $this->tienda = $tienda;

        return $this;
    }

    
    /**
     * Get un usuario tiene un cliente
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set un usuario tiene un cliente
     *
     * @return  self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }


    /*MAIN METHODS*/

    private function generateId(){
        $this->id = "EMP:" . spl_object_hash($this);
    }





}
?>