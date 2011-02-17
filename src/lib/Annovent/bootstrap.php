<?php

include_once 'functions.php';

function Annovent_Autoload($classname)
{
  $currentDir = __DIR__;
  $classPath = $currentDir . '/..'.DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
  if (file_exists($classPath))
  {
    include_once $classPath;
  }
}

spl_autoload_register('Annovent_Autoload');