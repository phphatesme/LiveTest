<?php

namespace Unit\LiveTest\TestRun\Mockups;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Extensions\Extension;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class TestExtension implements Extension
{
  public function __construct($runId, \Zend_Config $config = null, $arguments = null)
  {
  }
  
  public function preRun(Properties $properties)
  {
    
  }
  
  public function handleResult(Result $result, Response $response)
  {
    
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    
  }
  
  public function postRun(Information $information)
  {
  }
}