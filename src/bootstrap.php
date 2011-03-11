<?php
// -----------------------------------------------------------------------
//  Include 3rd party dependecies
// -----------------------------------------------------------------------

include_once 'lib/Symfony/Component/ClassLoader/UniversalClassLoader.php';

$classLoader = new \Symfony\Component\ClassLoader\UniversalClassLoader();

$classLoader->registerNamespace('Doctrine', 'lib');
$classLoader->registerNamespace('Symfony', 'lib');
$classLoader->registerNamespace('Base', 'lib');

// include the Annovent event despatcher
include_once 'lib/Annovent/bootstrap.php';

// include zend framework
set_include_path(__DIR__ . '/lib' . PATH_SEPARATOR . get_include_path());
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

// -----------------------------------------------------------------------
//  Include LiveTest classes and functions
// -----------------------------------------------------------------------

$classLoader->registerNamespace('LiveTest', __DIR__);
$classLoader->register();