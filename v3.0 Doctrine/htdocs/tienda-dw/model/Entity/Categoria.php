<?php

namespace Entity;
/**
 * @Entity(repositoryClass="Repository\CategoriaRepository")
 * @Table("categoria")
 */

 class Categoria
 {
     /**
      * @Id @GeneratedValue
      * @Column(name="id", type="integer", nullable=false)
      */
      private $id;

      /**
       * @Column(name="nombre",length=45, nullable=false)
       */
      private $nombre;
      /**
       * @Column(name="acronimo",length=45, nullable=false)
       */
      private $acronimo;
      /**
       * @Column(name="descripcion",length=200, nullable=false)
       */
      private $descripcion;

    /**
     * Una Categoria tiene muchos productos
     * @OneToMany(targetEntity="Producto", mappedBy="categoria")
     */
    private $productos;

    public function __construct()
    {
        $this->productos = new \Doctrine\Common\Collections\ArrayCollection();  
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
     * Get una Categoria tiene muchos productos
     */ 
    public function getProductos()
    {
        return $this->productos;
    }

    /**
     * Set una Categoria tiene muchos productos
     *
     * @return  self
     */ 
    public function setProductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }

      /**
       * Get the value of descripcion
       */ 
      public function getDescripcion()
      {
            return $this->descripcion;
      }

      /**
       * Set the value of descripcion
       *
       * @return  self
       */ 
      public function setDescripcion($descripcion)
      {
            $this->descripcion = $descripcion;

            return $this;
      }

      /**
       * Get the value of acronimo
       */ 
      public function getAcronimo()
      {
            return $this->acronimo;
      }

      /**
       * Set the value of acronimo
       *
       * @return  self
       */ 
      public function setAcronimo($acronimo)
      {
            $this->acronimo = $acronimo;

            return $this;
      }
 }

?>