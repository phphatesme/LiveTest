<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;

use Base\Http\ConnectionStatus;
use Base\Http\Response;

use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

interface Extension
{
  public function __construct($runId,\Zend_Config $config = null, $arguments = null);
  
  /**
   * This function is called before the test run starts. If it returns false 
   * the test run will not be started.
   * 
   * @param Properties $properties
   * @return boolean 
   */
  public function preRun(Properties $properties);
  
  public function handleConnectionStatus(ConnectionStatus $status);
  
  public function handleResult(Result $result, Response $response);
  
  public function postRun(Information $information);
}