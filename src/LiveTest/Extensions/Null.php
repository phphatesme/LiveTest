<?php

namespace LiveTest\Extensions;

use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Extensions\Extention;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class Null implements Extension
{
  public function __construct($runId, \Zend_Config $config = null)
  {
  }
  
  public function preRun(Properties $properties)
  {
    
  }
  
  public function handleResult(Result $result, \Zend_Http_Response $response)
  {
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    
  }
  
  public function postRun()
  {
  }
}