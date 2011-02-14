<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;

use Base\Http\ConnectionStatus;
use Base\Http\Response;

use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class Verbose implements Extension
{
  private $arguments;
  private $verbose = false;
  
  public function __construct($runId, \Zend_Config $config = null, $arguments = null)
  {
    $this->arguments = $arguments;
  }
  
  public function preRun(Properties $properties)
  {
    if (array_key_exists('verbose', $this->arguments))
    {
      $this->verbose = true;
    }
    return true;
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    if( $this->verbose ) {
      echo "\n  - Connection: ".$status->getUri()->toString()." - ".$status->getType();
    }    
  }
  
  public function handleResult(Result $result, Response $response)
  {
    if( $this->verbose ) {
      echo "\n  HandleResult: - ".$result->getUrl();
    }
  }
  
  public function postRun(Information $information)
  {
  }
}