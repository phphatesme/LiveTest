<?php

include_once __DIR__ . '/functions.php';

function Base_Autoload($classname)
{
  if (substr($classname, 0, 4) == 'Base')
  {
    $currentDir = __DIR__;
    $classPath = $currentDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    if (file_exists($classPath))
    {
      include_once $classPath;
    }
  }
}

spl_autoload_register('Base_Autoload');