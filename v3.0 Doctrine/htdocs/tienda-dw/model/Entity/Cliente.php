<?php

namespace Entity;

/**
 * @Table("cliente")
 * @Entity(repositoryClass="Repository\ClienteRepository")
 */

class Cliente
{


    /**
     * @Id
     * @Column(name="id",length=45, nullable=false, unique=true)
     * @GeneratedColumn(strategy="NONE")
     */
    private $id;
    /**
     * @Column(name="domicilio",length=45, nullable=true)
     */
    private $domicilio;
    /**
     * @Column(name="saldo",type="float", nullable=false)
     */
    private $saldo;

    /*                      F O R E I G N   K E Y S
    */

    /**
     * Un cliente tienen una ubicacion
     * @ManyToOne(targetEntity="Ubicacion")
     * @JoinColumn(name="Ubicacion_idUbicacion", referencedColumnName="idUbicacion")
     */
    private $ubicacion;
    /**
     * Una cesta tiene un cliente
     * @OneToOne(targetEntity="Cesta", mappedBy="cliente")
     */
    private $cesta;
    /**
     * Un cliente tiene un usuario asociado
     * @OneToOne(targetEntity="Usuario")
     * @JoinColumn(name="Usuario_idUsuario", referencedColumnName="idUsuario")
     */
    private $idUsuario;






    public function __construct(){
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
     * Get the value of domicilio
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set the value of domicilio
     *
     * @return  self
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get the value of saldo
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set the value of saldo
     *
     * @return  self
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get un cliente tienen una ubicacion
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set un cliente tienen una ubicacion
     *
     * @return  self
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get una cesta tiene un cliente
     */
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set una cesta tiene un cliente
     *
     * @return  self
     */
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }

    /**
     * Get un idUsuario tiene un cliente
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set un idUsuario tiene un cliente
     *
     * @return  self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }


    /*MAIN METHODS*/

    private function generateId(){
        $this ->id = "CLI:" . spl_object_hash($this);
    }




}
?>
