<?php

include_once __DIR__.'/../src/bootstrap.php';
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

function LiveTestUnit_Autoload($classname)
{
  $currentDir = __DIR__;
  //$classname = str_replace('Test\\', '\\', $classname);
  $classPath = $currentDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname).'.php';
  var_dump($classPath);
  //die();
  if ( file_exists( $classPath )) {
    include_once $classPath;
  }
}

spl_autoload_register('LiveTestUnit_Autoload');
