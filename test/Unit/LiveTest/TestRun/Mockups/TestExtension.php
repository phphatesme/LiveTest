<?php

namespace Unit\LiveTest\TestRun\Mockups;

use Base\Cli\Exception;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Extensions\Extension;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use Unit\LiveTest\TestRun\Mockups\SuccessException;

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
  	if($status->getType() == $status::ERROR)
  	{
  		throw new ErrorException('Connection Failed');
  	}
  	else
  	{
  		throw new SuccessException('Connection OK');
  	}
  }
  
  public function postRun(Information $information)
  {
  }
}