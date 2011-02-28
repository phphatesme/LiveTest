<?php

namespace LiveTest\Config\Tags\Config;

use LiveTest\Config\ConfigConfig;

class IncludePaths extends Base
{
  private $includedPaths = array();

  protected function doProcess(ConfigConfig $config, $paths)
  {
    $this->includedPaths = $paths;

    foreach ( $paths as $path )
    {
      set_include_path(get_include_path() . PATH_SEPARATOR . $path);
    }

    spl_autoload_register(array ($this, 'autoload' ));
  }

  public function autoload($classname)
  {
    foreach ( $this->includedPaths as $path )
    {
      $classPath = $path . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
      if (file_exists($classPath))
      {
        include_once $classPath;
      }
    }
  }
}