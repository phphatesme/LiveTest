<?php

// @todo: defensiver programmieren

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Report\Format\SimpleList;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class Report implements Extension
{
  private $resultSet;
  private $config;
  private $logStatuses = array();
  private $connectionStatuses = array( );
  
  public function __construct($runId,\Zend_Config $config = null, $arguments = null)
  {
    $this->resultSet = new ResultSet();
    $this->config = $config;
    
    if (!is_null($config->log_statuses))
    {
      $this->logStatuses = $config->log_statuses->toArray();
    }
    else
    {
      $this->logStatuses = array(Result::STATUS_ERROR,Result::STATUS_FAILED,Result::STATUS_SUCCESS);
    }
  }
  
  public function preRun(Properties $properties)
  {
  
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    if ($status->getType() == ConnectionStatus::ERROR)
    {
      $this->connectionStatuses[] = $status;
    }
  }
  
  public function handleResult(Result $result, Response $response)
  {
    if (in_array($result->getStatus(), $this->logStatuses))
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
  
  private function getFormat()
  {
    $formatClass = $this->config->format->class;
    $formatParams = $this->config->format->parameter;
    return new $formatClass($formatParams);
  }
  
  public function postRun(Information $information)
  {
    $writer = $this->getWriter();
    $format = $this->getFormat($information);
    $report = new \LiveTest\Report\Report($writer, $format, $this->resultSet, $this->connectionStatuses, $information);
    $report->render();
  }
}