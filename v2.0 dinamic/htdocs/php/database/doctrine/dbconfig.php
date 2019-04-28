<?php
/* Fichero de configuracion de la base de datos 
   que habra que incluir en todos los scripts de nuestro 
   proyecto que vayan a hacer uso de la BD */
   
require_once "vendor/autoload.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

function GetEntityManager()
{
    $paths = array("model/Entity","model/Repository");
    $isDevMode = false;

    // the connection configuration
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'bd_ejemplo',
        'host'     => 'localhost',
        'port'     => 3307
    );

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $em = EntityManager::create($dbParams, $config);

    return $em;
}