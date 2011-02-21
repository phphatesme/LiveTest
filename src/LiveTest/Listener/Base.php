<?php

namespace LiveTest\Listener;

use Annovent\Event\Dispatcher;

abstract class Base implements Listener
{
  /**
   * The unique run id
   * @var string
   */
  private $runId;
  
  /**
   * The event dispatcher.
   * @var Dispatcher
   */
  private $eventDispatcher;
  
  public function __construct($runId, Dispatcher $eventDispatcher)
  {
    $this->runId = $runId;
    $this->eventDispatcher = $eventDispatcher;
  }
  
  /**
   * This function returns the unique run id.
   * 
   * @return string
   */
  protected function getRunId( )
  {
    return $this->runId;
  }
  
  /**
   * This function returns the event dispatcher which can be used to notify events and register 
   * listener.
   *
   * @return Dispatcher
   */
  protected function getEventDispatcher( )
  {
    return $this->eventDispatcher;
  }
}