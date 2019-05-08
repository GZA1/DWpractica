<?php

namespace Entities;

/**
 * @Entity
 */

class Cesta
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     */
    private $id;

    /**
     * @Column(type="float", nullable=false)
     */
    private $costeTotal;
}
?>