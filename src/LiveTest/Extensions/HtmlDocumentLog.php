<?php

namespace LiveTest\TestRun\Result\Handler;

use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\Extensions\Extension;

class HtmlDocumentLog implements Extension
{
  private $logPath;
  private $runId; 
  
  public function __construct($runId, \Zend_Config $config = null)
  {
    $this->logPath = $config->log_path.'/'.$runId.'/';
    mkdir( $this->logPath );
  }
  
  public function preRun(Properties $properties)
  {
    
  }
  
  public function handleResult(Result $result, \Zend_Http_Response $response)
  {
    $filename = $this->logPath . '/' . urlencode($result->getUrl());
    file_put_contents($filename, $response->getBody() );
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    
  }
  
  public function postRun()
  {
  }
}