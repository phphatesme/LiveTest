<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;

use Base\Http\Response;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Properties;

/**
 * This extension is used to let the application sleep after a test ran. This is used
 * to not DOS attack a server.
 * 
 * @author Nils Langner
 *
 */
class Sleep implements Extension
{
  private $sleepTime;
  
  /**
   * Sets the sleep duration
   */
  public function __construct($runId, \Zend_Config $config = null, $arguments = null)
  {
    $this->sleepTime = $config->sleep_time;
  }

  /**
   * not used
   */
  public function preRun(Properties $properties)
  {
    
  }
  
  /**
   * not used
   */
  public function handleResult(Result $result, Response $response)
  {
     
  }
  
  /**
   * Lets the application sleep for a defined time
   * 
   * @param ConnectionStatus $status
   */
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    sleep( $this->sleepTime );
  }
  
  /**
   * not used
   */
  public function postRun(Information $information)
  {
  }
}