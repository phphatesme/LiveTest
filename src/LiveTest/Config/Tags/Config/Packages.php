<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\Config;

use LiveTest\Config\ConfigConfig;

/**
 * This tag is used to extend the include path. It is needed because it must be possible to
 * extend LiveTest without touching the core.
 *
 * @example
 *  Packages:
 *   - /tmp
 *   - c:/
 *
 * @author Nils Langner
 */
class Packages extends Base
{
  private $includedPaths = array();

  /**
   * @see LiveTest\Config\Tags\Config.Base::doProcess()
   */
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