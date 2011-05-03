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
 * This tag is used to set include pathes (include_path).
 *
 * @author Mike Lohmann
 */
class IncludePaths extends Base
{
  /**
   * @see LiveTest\Config\Tags\Config.Base::doProcess()
   * @param ConfigConfig $config
   * @param array $pathes
   */
  
  protected function doProcess(ConfigConfig $config, $pathes)
  {
  	$this->setIncludePathes($pathes);
  }
  
  
  /**
   * 
   * Added the pathes to the include_path
   * @param array $pathes
   * @throws Exception
   */
  private function setIncludePathes(array $pathes)
  {
  	 $computedPathes = '';
  	 
  	 foreach($pathes as $aPath)
  	 {
  	   $computedPathes .= ':'.$aPath;
  	 }
    
     if(false === @set_include_path(get_include_path().$computedPathes))
     {
       $lastError = error_get_last();
       throw new \InvalidArgumentException('Cannot set the includePath: ' . $lastError ); 
     }
  }
}