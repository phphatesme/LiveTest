<?php

namespace Base\Timer;

class Timer
{
  private $startTime;
  private $stopTime;
  
  /**
   * This function starts the timer
   */
  public function __construct()
  {
    $this->start();
  }

  /**
   * This function resets and starts the timer.
   * 
   * @return int the current time
   */
  public function start( )
  {
    $this->startTime = time();
    return $this->startTime;
  }
  
  /**
   * This function stops the timer.
   * 
   * @return int the elapsed time
   */
  public function stop( )
  {
    $this->stopTime = time();
    return $this->stopTime - $this->startTime;
  }
  
  /**
   * Returns the start time
   * 
   * @return int start time
   */
  public function getStartTime()
  {
    return $this->startTime;
  }
  
  /**
   * Returns the elapsed time without stoping the timer.
   * 
   * @return int elapsed time
   */
  public function getElapsedTime()
  {
    return time() - $this->startTime;
  }
}