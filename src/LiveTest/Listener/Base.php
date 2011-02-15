<?php

namespace LiveTest\Listener;

use Annovent\Event\Dispatcher;

abstract class Base implements Listener
{
  private $runId;
  private $config;
  private $eventDispatcher;
  private $arguments;
  
  public function __construct($runId, \Zend_Config $config, array $arguments, Dispatcher $eventDispatcher)
  {
    $this->runId = $runId;
    $this->config = $config;
    $this->eventDispatcher = $eventDispatcher;
    $this->arguments = $arguments;
  }
  
  /**
   * Returns the command line arguments
   * 
   * @return array
   */
  protected function getArguments( )
  {
    return $this->arguments;
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
   * This function returns the config for this listener.
   * 
   * @return \Zend_Config
   */
  protected function getConfig( )
  {
    return $this->config;
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