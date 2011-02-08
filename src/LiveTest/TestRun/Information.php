<?php

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