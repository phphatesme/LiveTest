<?php

// include zend framework 1
use Doctrine\Common\Annotations\AnnotationReader;
set_include_path(__DIR__ . '/lib' . PATH_SEPARATOR . get_include_path());
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

// include standard namespaces
include_once 'lib/Symfony/Component/ClassLoader/UniversalClassLoader.php';

$classLoader = new \Symfony\Component\ClassLoader\UniversalClassLoader();

$classLoader->registerNamespace('Doctrine', __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('Symfony' , __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('Base'    , __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('Annovent', __DIR__.DIRECTORY_SEPARATOR.'lib');

$classLoader->registerNamespace('LiveTest', __DIR__);

$classLoader->register();