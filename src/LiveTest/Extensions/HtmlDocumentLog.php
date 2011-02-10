<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;
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
  
  public function __construct($runId,\Zend_Config $config = null, $arguments = null)
  {
    $this->logPath = $config->log_path . '/' . $runId . '/';
    if (!file_exists($this->logPath))
    {
      mkdir($this->logPath);
    }
  }
  
  public function preRun(Properties $properties)
  {
  
  }
  
  public function handleResult(Result $result, Response $response)
  {
    $filename = $this->logPath . '/' . urlencode($result->getUrl());
    file_put_contents($filename, $response->getBody());
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
  
  }
  
  public function postRun(Information $information)
  {
  }
}