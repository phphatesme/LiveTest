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
  /**
   * The constructor
   * 
   * @param $runId The unique test run id
   * @param \Zend_Config $config The parameters defined in the test suite configuration
   * @param unknown_type $arguments The command line arguments
   */
  public function __construct($runId,\Zend_Config $config = null, $arguments = null);
  
  /**
   * This function is called before the test run starts. If it returns false 
   * the test run will not be started.
   * 
   * @param Properties $properties
   * @return boolean 
   */
  public function preRun(Properties $properties);
  
  /**
   * This function is called when the test runner is connecting via http. 
   * 
   * @param ConnectionStatus $status
   */
  public function handleConnectionStatus(ConnectionStatus $status);
  
  /**
   * This function is called after a single test ran
   * 
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response);
  
  /**
   * This function is called after the test run.
   * 
   * @param Information $information
   */
  public function postRun(Information $information);
}