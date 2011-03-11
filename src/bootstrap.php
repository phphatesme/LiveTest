<?php

// include standard namespaces
include_once 'lib/Symfony/Component/ClassLoader/UniversalClassLoader.php';

$classLoader = new \Symfony\Component\ClassLoader\UniversalClassLoader();

$classLoader->registerNamespace('Doctrine', __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('Symfony' , __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('Zend'    , __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('Base'    , __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('Annovent', __DIR__.DIRECTORY_SEPARATOR.'lib');
$classLoader->registerNamespace('phmLabs' , __DIR__.DIRECTORY_SEPARATOR.'lib');

$classLoader->registerNamespace('LiveTest', __DIR__);

$classLoader->register();