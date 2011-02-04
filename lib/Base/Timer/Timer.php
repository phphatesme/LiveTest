<?php

namespace Base\Timer;

class Timer
{
  private $startTime;
  private $stopTime;
  
  public function __construct()
  {
    $this->start();
  }
  
  public function start( )
  {
    $this->startTime = time();
    return $this->startTime;
  }
  
  public function stop( )
  {
    $this->stopTime = time();
    return $this->stopTime - $this->startTime;
  }
  
  public function getStartTime()
  {
    return $this->startTime;
  }
  
  public function getElapsedTime()
  {
    return time() - $this->startTime;
  }
}