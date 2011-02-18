<?php

namespace LiveTest\Listener\Cli;

use LiveTest\Listener\Base;
use LiveTest\TestRun\Information;
use LiveTest\TestRun\Result\Result;

use Base\Http\Response\Response;

/**
 * This listener is used to echo a status bar with all important collected information
 * of the test run.
 *
 * @author Nils Langner
 */
class StatusBar extends Base
{
  /**
   * Number of tests that were called
   * @var int
   */
  private $testCount = 0;

  /**
   * Number of tests with errors
   * @var int
   */
  private $errorCount = 0;

  /**
   * Number of failures
   * @var int
   */
  private $failureCount = 0;

  /**
   * Number of succeeded tests
   * @var int
   */
  private $successCount = 0;

  /**
   * @event LiveTest.Run.HandleResult
   *
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response)
  {
    $this->testCount++;

    switch ($result->getStatus())
    {
      case Result::STATUS_SUCCESS :
        $this->successCount++;
        break;
      case Result::STATUS_ERROR :
        $this->errorCount++;
        break;
      case Result::STATUS_FAILED :
        $this->failureCount++;
        break;
    }
  }

  /**
   * This function returns the formatted duration. Splits the given seconds into minuts and hours.
   *
   * @todo this should be part of the BaseLibrary
   *
   * @param int $duration
   */
  private function getFormattedDuration($duration)
  {
    if ($duration < 60)
    {
      return $duration . ' second(s)';
    }
    else if ($duration < 3600)
    {
      $seconds = $duration % 60;
      $minutes = floor($duration / 60);
      return $minutes . ' minute(s) ' . $seconds . ' second(s)';
    }
    else
    {
      $seconds = $duration % 60;
      $minutes = floor(($duration % 3600) / 60);
      $hours = floor($duration / 3600);
      return $hours . ' hour(s) ' . $minutes . ' minute(s) ' . $seconds . ' second(s)';
    }
    return $duration . ' seconds';
  }

  /**
   * This function echoes the the duration, number of tests (errors and failures).
   *
   * @event LiveTest.Run.PostRun
   *
   * @param Information $information
   */
  public function postRun(Information  $information)
  {
    echo "  Tests: " . $this->testCount . ' (failed: '.$this->failureCount.', error: '.$this->errorCount.') - Duration: ' . $this->getFormattedDuration($information->getDuration());
  }
}