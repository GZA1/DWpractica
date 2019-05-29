<?php
// dbconfig.php

/* Fichero de configuracion de la base de datos
   que habra que incluir en todos los scripts de nuestro
   proyecto que vayan a hacer uso de la BD */

require_once 'vendor/autoload.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


function GetEntityManager()
{
    $paths = array(__DIR__."/src/Entities", __DIR__."/src/Repository");
    $isDevMode = false;

    // the connection configuration
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => 'root',
        'dbname'   => 'bd_tienda',
        'host'     => 'localhost',
        'port'     => 3306
    );
    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    // obtaining the entity manager
    $em = EntityManager::create($dbParams, $config);
    echo "hola2";
    return $em;
}
?>
