<?php

// -----------------------------------------------------------------------
//  Include 3rd party dependecies
// -----------------------------------------------------------------------

// include the sfYaml parser of the symfony components
include_once 'lib/SymfonyComponents/Yaml/sfYaml.php';

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

// include the live test functions
include_once 'LiveTest/functions.php';

// register livetest autoloader
function LiveTest_Autoload($classname)
{
  $currentDir = __DIR__;
  $classPath = $currentDir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
  if (file_exists($classPath))
  {
    include_once $classPath;
  }
}

spl_autoload_register('LiveTest_Autoload');