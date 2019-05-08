<?php

namespace Entities;
/**
 * @Entity
 */

 class Categoria
 {
     /**
      * @Id
      * @Column(type="integer", nullable=false)
      */
      private $id;
      /**
       * @Column(length=45, nullable=false)
       */
      private $nombre;

 }

?>