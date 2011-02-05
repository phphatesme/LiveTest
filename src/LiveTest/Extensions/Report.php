<?php
// @todo: defensiver programmieren

namespace LiveTest\Extensions;

use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Report\Format\List;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class Report implements Extension
{
  private $resultSet;
  private $config;
  
  public function __construct($runId,\Zend_Config $config = null)
  {
    $this->resultSet = new ResultSet();
    $this->config = $config;
  }
  
  public function preRun(Properties $properties)
  {
    
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    \\@todo handle connections errors
  }
  
  public function handleResult(Result $result, \Zend_Http_Response $response)
  {
    if ($result->getStatus() != Result::STATUS_SUCCESS)
    {
      $this->resultSet->addResult($result);
    }
  }
  
  private function getWriter()
  {
    $writerClass = $this->config->writer->class;
    $writerParams = $this->config->writer->parameter;
    return new $writerClass($writerParams);
  }
  
  public function postRun()
  {
    $writer = $this->getWriter();
    $report = new \LiveTest\Report\Report($writer, new List(), $this->resultSet);
    $report->render();
  }
}
