<?php

namespace LiveTest\Listener;

use Base\Http\Response;

use LiveTest\TestRun\Information;
use LiveTest\TestRun\Result\Result;

class StatusBar extends Base
{
  private $testCount = 0;
  
  private $errorCount = 0;
  private $failureCount = 0;
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
      return $hours . ' hour(s)' . $minutes . ' minute(s) ' . $seconds . ' second(s)';
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
    echo "\n\n  Tests: " . $this->testCount . ' (failed: '.$this->failureCount.', error: '.$this->errorCount.') - Duration: ' . $this->getFormattedDuration($information->getDuration());
    echo "\n";
  }
}