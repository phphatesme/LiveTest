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
  public function start()
  {
    $this->startTime = microtime(true);
    return floor($this->startTime*1000);
  }

  /**
   * This function stops the timer.
   *
   * @return int the elapsed time
   */
  public function stop()
  {
    $this->stopTime = microtime(true);
    return floor(($this->stopTime - $this->startTime) * 1000);
  }

  /**
   * Returns the start time
   *
   * @return int start time
   */
  public function getStartTime()
  {
    return floor($this->startTime * 1000);
  }

  /**
   * Returns the elapsed time without stoping the timer.
   *
   * @return int elapsed time
   */
  public function getElapsedTime()
  {
  	$elapsed = microtime(true);
    return floor(($elapsed - $this->startTime) * 1000);
  }
}