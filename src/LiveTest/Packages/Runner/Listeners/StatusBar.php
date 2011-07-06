<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Runner\Listeners;

use Base\Date\Duration;

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
   * @Event("LiveTest.Run.HandleResult")
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
   * This function echoes the the duration, number of tests (errors and failures).
   *
   * @Event("LiveTest.Run.PostRun")
   *
   * @param Information $information
   */
  public function postRun(Information $information)
  {
  	$formattedDuration = Duration::format($information->getDuration(), '%d day(s) ', '%d hour(s) ', '%d minute(s) ', '%d second(s)' );
    echo "  Tests: " . $this->testCount . ' (failed: '.$this->failureCount.', error: '.$this->errorCount.') - Duration: ' . $formattedDuration;
  }
}