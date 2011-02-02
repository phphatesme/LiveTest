<?php

namespace LiveTest\Extensions;

use Base\Http\Response;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Properties;

class Sleep implements Extension
{
  private $sleepTime;
  
  public function __construct($runId, \Zend_Config $config = null)
  {
    $this->sleepTime = $config->sleep_time;
  }
  
  public function preRun(Properties $properties)
  {
    
  }
  
  public function handleResult(Result $result, Test $test, \Zend_Http_Response $response)
  {
     sleep( $this->sleepTime );
  }
  
  public function postRun()
  {
  }
}