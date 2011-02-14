<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Extensions\Extention;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

/**
 * This extension can be used to overwrite default extensions. If you register for example
 * a null extension with the name ProgressBar, sthe standard progress bar will not be shown.
 * 
 * @author Nils Langner
 */
class Null implements Extension
{
  /**
   * do nothing
   */
  public function __construct($runId, \Zend_Config $config = null, $arguments = null)
  {
  }
  
  /**
   * do nothing
   */
  public function preRun(Properties $properties)
  {
    
  }
  
  /**
   * do nothing
   */
  public function handleResult(Result $result, Response $response)
  {
  }
  
  /**
   * do nothing
   */
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    
  }

  /**
   * do nothing
   */
  public function postRun(Information $information)
  {
  }
}