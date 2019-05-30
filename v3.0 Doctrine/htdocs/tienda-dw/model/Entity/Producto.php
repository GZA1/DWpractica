<?php

namespace Entity;

/**
 * @Entity(repositoryClass="Repository\ProductoRepository")
 */

class Producto 
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", nullable=false)
     */
    private $id;
    /**
     * @Column(name="nombre", length=45, nullable=false)
     */
    private $nombre;
    /**
     * @Column(name="marca", length=45, nullable=false)
     */
    private $marca;
    /**
     * @Column(name="modelo", length=45, nullable=false)
     */
    private $modelo;
    /**
     * @Column(name="precio", type="float", nullable=false)
     */
    private $precio;

    /**
     * Un producto tiene muchas unidades
     * @OneToMany(targetEntity="Unidad", mappedBy="producto")
     */
    private $unidades;

    /**
     * Un producto es de una categoria
     * @ManyToOne(targetEntity="Categoria", inversedBy="productos")
     * @JoinColumn(name="Categoria_id", referencedColumnName="id")
     */
    private $categoria;

    public function __construct()
    {
        $this->unidades = new \Doctrine\Common\Collections\ArrayCollection();  
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
     * Get the value of marca
     */ 
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     *
     * @return  self
     */ 
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

        /**
     * Get the value of modelo
     */ 
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set the value of modelo
     *
     * @return  self
     */ 
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }


    /**
     * Get un producto tiene muchas unidades
     */ 
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set un producto tiene muchas unidades
     *
     * @return  self
     */ 
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * Get un producto es de una categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set un producto es de una categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }
}
?>