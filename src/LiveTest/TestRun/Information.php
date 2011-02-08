<?php

namespace LiveTest\TestRun;

class Information
{
  private $duration;
  
  public function __construct($duration)
  {
    $this->duration = $duration;
  }
  
  public function getDuration()
  {
    return $this->duration;
  }

}