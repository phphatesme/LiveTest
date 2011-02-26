<?php

namespace LiveTest\Config\Tags\Config;

use LiveTest\Config\ConfigConfig;

class IncludePaths extends Base
{
  protected function doProcess(ConfigConfig $config, $paths)
  {
    foreach ( $paths as $path )
    {
      set_include_path(get_include_path() . PATH_SEPARATOR . $path);
    }
    
    spl_autoload_register(array ($this, 'autoload' ));
  }
  
  public function autoload($classname)
  {
    $includePath = explode(PATH_SEPARATOR, get_include_path());
    foreach ( $includePath as $path )
    {
      $classPath = $path . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
      if (file_exists($classPath))
      {
        include_once $classPath;
      }
    }
  }
}