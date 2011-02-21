<?php

// @todo autoload vereinheitlichen
include_once 'lib/SymfonyComponents/Yaml/sfYaml.php';
include_once 'lib/Base/bootstrap.php';

include_once 'lib/Annovent/bootstrap.php';

include_once 'LiveTest/functions.php';

set_include_path(__DIR__ . '/lib' . PATH_SEPARATOR . get_include_path());
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

function LiveTest_Autoload($classname)
{
  $currentDir = __DIR__;
  $classPath = $currentDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
  if (file_exists($classPath))
  {
    include_once $classPath;
  }
}

function LiveTest_Extend_Autoload($classname)
{
  $includePath = explode(PATH_SEPARATOR, get_include_path());
  foreach ($includePath as $path)
  {
    $classPath = $path . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    if (file_exists($classPath))
    {
      include_once $classPath;
    }
  }
}

spl_autoload_register('LiveTest_Autoload');
spl_autoload_register('LiveTest_Extend_Autoload');