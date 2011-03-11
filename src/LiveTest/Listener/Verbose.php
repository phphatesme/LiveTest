<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Listener;

use Base\Http\ConnectionStatus;
use Base\Http\Response\Response;

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
   * @Event("LiveTest.Runner.Init")
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
   * @Event("LiveTest.Run.HandleConnectionStatus")
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
   * @Event("LiveTest.Run.HandleResult")
   *
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response)
  {
    if ($this->verbose)
    {
      echo "\n  HandleResult: - " . $result->getUri()->toString();
    }
  }
}