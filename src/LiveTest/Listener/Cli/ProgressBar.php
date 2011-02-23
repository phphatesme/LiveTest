<?php

namespace LiveTest\Listener\Cli;

use LiveTest\Listener\Base;
use LiveTest\TestRun\Result\Result;

use Base\Http\ConnectionStatus;
use Base\Http\Response\Response;

/**
 * This listener is used to visualize the test results as a pogress bar
 *
 * @author Nils Langner
 */
class ProgressBar extends Base
{
  /**
   * The width of the progressBar.
   *
   * @todo this should also be configured via parameter
   *
   * @var int
   */
  const LINE_BREAK_AT = 70;

  /**
   * The internal echo counter. Used to create new lines at the right position.
   * @var int
   */
  private $counter = 0;

  /**
   * This function echoes a '*' if a test succeeded, 'e' if an error occured and 'f' if a test failed.
   *
   * @event LiveTest.Run.HandleResult
   *
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response)
  {
    switch ($result->getStatus())
    {
      case Result::STATUS_SUCCESS :
        $this->echoChar('*');
        break;
      case Result::STATUS_FAILED :
        $this->echoChar('f');
        break;
      case Result::STATUS_ERROR :
        $this->echoChar('e');
        break;
    }
  }

  /**
   * This function echoes a E if the connection failed.
   *
   * @event LiveTest.Run.HandleConnectionStatus
   *
   * @param ConnectionStatus
   */
  public function handleConnectionStatus(ConnectionStatus $connectionStatus)
  {
    if ($connectionStatus->getType() == ConnectionStatus::ERROR)
    {
      $this->echoChar('E');
    }
  }

  /**
   * Prints a character a the right position. Creates new lines a the "Running: " prefix.
   *
   * @param char $char
   */
  private function echoChar($char)
  {
    if ($this->counter == 0)
    {
      echo '  Running: ';
    }

    if ($this->counter % self::LINE_BREAK_AT == 0 && $this->counter != 0)
    {
      echo "\n           ";
    }
    echo $char;
    $this->counter++;
  }
}