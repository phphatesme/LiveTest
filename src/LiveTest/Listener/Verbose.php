<?php

namespace LiveTest\Listener;

use Base\Http\ConnectionStatus;
use Base\Http\Response;

use LiveTest\TestRun\Result\Result;

/**
 * This listener echoes the connection status and the current url that is tested.
 * Can be switched on withe the command line parameter --verbose
 * 
 * @author Nils Langner
 */
class Verbose extends Base
{
  /**
   * Indicates if the verbose mode is on.
   * 
   * @var bool
   */
  private $verbose = false;
  
  /**
   * Checks if the --verbose argument is set.
   * 
   * @event LiveTest.Runner.Init
   * 
   * @param array $arguments
   */
  public function runnerInit(array $arguments)
  {
    if (array_key_exists('verbose', $arguments))
    {
      $this->verbose = true;
    }
    return true;
  }
  
  /**
   * Echoes the connection status
   * 
   * @event LiveTest.Run.HandleConnectionStatus 
   * 
   * @param ConnectionStatus $status
   */
  public function handleConnectionStatus(ConnectionStatus $connectionStatus)
  {
    if ($this->verbose)
    {
      echo "\n  - Connection: " . $connectionStatus->getUri()->toString() . " - " . $connectionStatus->getType();
    }
  }
  
  /**
   * Echoes the url that was tested. 
   * 
   * @event LiveTest.Run.HandleResult
   * 
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response)
  {
    if ($this->verbose)
    {
      echo "\n  HandleResult: - " . $result->getUrl();
    }
  }
}