<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use Base\Www\Uri;

class Information
{
  private $duration;
  private $defaultDomain;
  
  public function __construct($duration, Uri $defaultDomain )
  {
    $this->duration = $duration;
    $this->defaultDomain = $defaultDomain;
  }
  
  public function getDefaultDomain( )
  {
    return $this->defaultDomain;
  }
  
  public function getDuration()
  {
    return $this->duration;
  }
}