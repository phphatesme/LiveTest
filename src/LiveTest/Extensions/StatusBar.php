<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;
use Base\Http\Response;

use LiveTest\TestRun\Properties;
use LiveTest\Extensions\Extention;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class StatusBar implements Extension
{
  private $testCount = 0;
  
  private $errorCount = 0;
  private $failureCount = 0;
  private $successCount = 0;
  
  public function __construct($runId, Zend_Config $config = null)
  {
  }
  
  public function preRun(Properties $properties)
  {
  
  }
  
  public function handleResult(Result $result, \Zend_Http_Response $response)
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
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    
  }
  
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
  
  public function postRun(Information $information)
  {
    echo "\n  Tests: " . $this->testCount . ' (failed: '.$this->failureCount.', error: '.$this->errorCount.') - Duration: ' . $this->getFormattedDuration($information->getDuration());
  }
}