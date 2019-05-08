<?php

namespace Entities;

/**
 * @Entity
 */
class Unidad
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     */
    private $id;
    /**
     * @Column(type="boolean", nullable=false)
     */
    private $vendido;
}
?>