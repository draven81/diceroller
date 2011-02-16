<?php

// Show errors for developing
error_reporting(E_ALL);
ini_set('display_errors',1);

if(file_exists('./config.inc.php')) {
	$config = parse_ini_file('config.inc.php',true);
}
// Loading phpab and doctrine
require_once 'autoload.inc.php';
require_once 'doctrine.inc.php';

use Doctrine\Common\ClassLoader;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Cache\ApcCache;

require 'Doctrine/Common/ClassLoader.php';
$doctrineClassLoader = new ClassLoader('Doctrine', realpath(__DIR__ . '/lib'));
$doctrineClassLoader->register();
// Autoloading für unsere Modelle
$entitiesClassLoader = new ClassLoader('Models', __DIR__);
$entitiesClassLoader->register();
// Autoloading für die Doctrine-Proxy-Klassen
$proxiesClassLoader = new ClassLoader('Proxies', __DIR__);
$proxiesClassLoader->register();

$config = new \Doctrine\ORM\Configuration();
// Wir verwenden die neue Annotations-Syntax für die Modelle (Alternativen: yaml und xml-Dateien)
$driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . "/Models"));
$config->setMetadataDriverImpl($driverImpl);
// Teile Doctrine mit, wo es die Proxy-Klassen ablegen soll
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Proxies');


$connectionOptions = array(
   'driver'   => 'pdo_mysql',
   'dbname'   => 'doctrine2_test',
   'host'     => 'localhost',
   'user'     => 'root',
   'password' => '',
);
// Instanz von Doctrine\ORM\EntityManager, dem zentralen Objekt des ORM von Doctrine.
// Über dieses Objekt werden alle Datenbank-Operationen abgewickelt.
$em = EntityManager::create($connectionOptions, $config);

var_dump($em->getConnection()); die();



?>
