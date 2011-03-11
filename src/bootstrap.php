<?php
// -----------------------------------------------------------------------
//  Include 3rd party dependecies
// -----------------------------------------------------------------------

include_once 'lib/Symfony/Component/ClassLoader/UniversalClassLoader.php';

$classLoader = new \Symfony\Component\ClassLoader\UniversalClassLoader( );
$classLoader->registerNamespace('Doctrine', 'lib/Doctrine');
$classLoader->registerNamespace('Symfony', 'lib/Symfony');
$classLoader->registerNamespace('Base', 'lib/Base');

// include the base library
include_once 'lib/Base/bootstrap.php';

// include the Annovent event despatcher
include_once 'lib/Annovent/bootstrap.php';

// include zend framework
set_include_path(__DIR__ . '/lib' . PATH_SEPARATOR . get_include_path());
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

// -----------------------------------------------------------------------
//  Include LiveTest classes and functions
// -----------------------------------------------------------------------

// include the LiveTest functions
include_once 'LiveTest/functions.php';

$classLoader->registerNamespace('LiveTest', __DIR__);
$classLoader->register();