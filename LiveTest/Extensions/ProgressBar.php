<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Extensions\Extention;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class ProgressBar implements Extension
{
  const LINE_BREAK_AT = 70;
  
  public function __construct($runId, \Zend_Config $config = null)
  {
  }
  
  public function preRun(Properties $properties)
  {
  }
  
  public function handleResult(Result $result, Test $test, \Zend_Http_Response $response)
  {
    static $counter = 0;
    
    if ($counter == 0)
    {
      echo '  Running: ';
    }
    
    if ($counter % self::LINE_BREAK_AT == 0 && $counter != 0)
    {
      echo "\n           ";
    }
    
    $counter++;
    
    switch ($result->getStatus())
    {
      case Result::STATUS_SUCCESS :
        echo '*';
        break;
      case Result::STATUS_FAILED :
        echo 'f';
        break;
      case Result::STATUS_ERROR :
        echo 'e';
        break;
    }
  }
  
  public function postRun()
  {
  }
}