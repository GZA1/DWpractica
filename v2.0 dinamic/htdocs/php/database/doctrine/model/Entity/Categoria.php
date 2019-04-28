<?php
namespace Entity;

/** 
 *  @Entity 
 *  @Table(name="catalogo_categorias")
 */
class Categoria
{
    /** @Id @GeneratedValue @Column(name="id", type="integer", nullable=false) */
    private $id;

    /** @Column(name="nombre", type="string", length=45, nullable=false) */
    private $nombre;

    /** @Column(name="fecha_creacion", type="datetime", nullable=false) */
    private $fechaCreacion;

    /** @Column(name="fecha_modificacion", type="datetime", nullable=false) */
    private $fechaModificacion;

    /** @OneToMany(targetEntity="Producto", mappedBy="categoria") */
    private $productos;

    public function __construct()
    {      
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();  
    }    

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
     * Get the value of fechaCreacion
     */ 
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set the value of fechaCreacion
     *
     * @return  self
     */ 
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get the value of fechaModificacion
     */ 
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set the value of fechaModificacion
     *
     * @return  self
     */ 
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get the value of productos
     */ 
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set the value of productos
     *
     * @return  self
     */ 
    public function addProducto($producto)
    {
        $this->productos[] = $producto;

        return $this;
    }
}