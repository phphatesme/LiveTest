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
 * This tag is used to set the date_default_time_zone (date.timezone).
 *
 * @author Mike Lohmann
 */
class DateDefaultTimezone extends Base
{
  /**
   * @see LiveTest\Config\Tags\Config.Base::doProcess()
   * @param ConfigConfig $config
   * @param String $timezone
   */
  
  protected function doProcess(ConfigConfig $config, $timezone)
  {
  	$this->setTimezone($timezone);
  }
  
  
  /**
   * 
   * Sets or overrides the date.timezone value.
   * @param String $timezone
   * @throws Exception
   */
  private function setTimezone( $timezone )
  {
  	
     if(false === @date_default_timezone_set( $timezone ))
     {
       $lastError = error_get_last();
       throw new \InvalidArgumentException('Cannot set the timezone: ' . $lastError ); 
     }
  }
}