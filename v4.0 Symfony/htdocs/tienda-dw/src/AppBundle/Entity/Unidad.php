<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnidadRepository")
 */

class Unidad
{
    /**
     * @ORM\Id @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;
    /**
     * @ORM\Column(name="vendido", type="boolean", nullable=false)
     */
    private $vendido;


    /**
    * Una unidad pertenece a una cesta
    * @ORM\ManyToOne(targetEntity="Cesta", inversedBy="unidades")
    * @ORM\JoinColumn(name="Cesta_id", referencedColumnName="id")
    */
    private $cesta;

    /**
    * Una unidad pertenece a una tienda
    * @ORM\ManyToOne(targetEntity="Tienda", inversedBy="unidades")
    * @ORM\JoinColumn(name="Tienda_id", referencedColumnName="id")
    */
    private $tienda;

    /**
    * Una unidad es de un producto
    * @ORM\ManyToOne(targetEntity="Producto", inversedBy="unidades")
    * @ORM\JoinColumn(name="Producto_id", referencedColumnName="id")
    */
    private $producto;




    public function __construct()
    {

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
     * Get the value of vendido
     */
    public function isVendido()
    {
        return $this->vendido;
    }

    /**
     * Set the value of vendido
     *
     * @return  self
     */
    public function setVendido($vendido)
    {
        $this->vendido = $vendido;

        return $this;
    }

    /**
     * Get una unidad pertenece a una cesta
     */
    public function getCesta()
    {
        return $this->cesta;
    }

    /**
     * Set una unidad pertenece a una cesta
     *
     * @return  self
     */
    public function setCesta($cesta)
    {
        $this->cesta = $cesta;

        return $this;
    }

    /**
     * Get una unidad pertenece a una tienda
     */
    public function getTienda()
    {
        return $this->tienda;
    }

    /**
     * Set una unidad pertenece a una tienda
     *
     * @return  self
     */
    public function setTienda($tienda)
    {
        $this->tienda = $tienda;

        return $this;
    }

    /**
     * Get una unidad es de un producto
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set una unidad es de un producto
     *
     * @return  self
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }
}
?>
