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
 * This tag is used to set the maximum memory LiveTest can use (set_max).
 *
 * @author Mike Lohmann
 */
class MemoryLimit extends Base
{
  /**
   * @see LiveTest\Config\Tags\Config.Base::doProcess()
   * @param ConfigConfig $config
   * @param array $pathes
   */
  
  protected function doProcess(ConfigConfig $config, $limit)
  {
  	$this->setMemoryLimit($limit);
  }
  
  
  /**
   * 
   * Sets the maximum limit
   * @param string $limit
   * @throws Exception
   */
  private function setMemoryLimit($limit)
  {
  	 if(false === @ini_set('memory_limit',$limit))
     {
       $lastError = error_get_last();
       throw new \InvalidArgumentException('Cannot set the memory limit: ' . $lastError ); 
     }
  }
}