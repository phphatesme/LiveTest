<?php

namespace LiveTest\Listener;

use LiveTest;

use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Information;
use Base\Http\Response;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

/**
 * This listener is used to provide all kind of reporting mechanism. Creating a report
 * is a two step task. You need to define a format (e.g Html or plain text) that will 
 * create a formatted string. The second step is to definethe writer. A writer takes a format 
 * and writes it (e.g file writer or e-mail writer).
 * 
 * @author Nils Langner
 */
class Report extends Base
{
  private $resultSet;
  private $logStatuses = array ();
  private $connectionStatuses = array ();
  
  private $writerConfig = array ();
  private $formatConfig = array ();
  
  /**
   * Initializing the format, writer and define the log statuses.
   * 
   * @param array $format
   * @param array $writer
   * @param array $logStatuses
   */
  public function init(array $format, array $writer, array $logStatuses = null)
  {
    $this->resultSet = new ResultSet();
    if (!is_null($logStatuses))
    {
      $this->logStatuses = $logStatuses;
    }
    else
    {
      $this->logStatuses = array (Result::STATUS_ERROR, Result::STATUS_FAILED, Result::STATUS_SUCCESS );
    }

    $this->initWriter( $writer );
    $this->initFormat( $format );    
  }
  
  /**
   * Collect all information about the connection errors.
   * 
   * @event LiveTest.Run.HandleConnectionStatus
   * 
   * @param ConnectionStatus $status
   */
  public function handleConnectionStatus(ConnectionStatus $connectionStatus)
  {
    if ($connectionStatus->getType() == ConnectionStatus::ERROR)
    {
      $this->connectionStatuses [] = $connectionStatus;
    }
  }
  
  /**
   * Collect all information about all tests.
   * 
   * @event LiveTest.Run.HandleResult
   * 
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response)
  {
    if (in_array($result->getStatus(), $this->logStatuses))
    {
      $this->resultSet->addResult($result);
    }
  }
  
  /**
   * Creates the writer class
   */
  private function initWriter($writerConfig)
  {
    $writerClass = $writerConfig ['class'];
    $this->writer = new $writerClass();
    $parameter = array ();
    if (array_key_exists('parameter', $writerConfig))
    {
      $parameter = $writerConfig['parameter'];
    }
    \LiveTest\initializeObject($this->writer, $parameter);
  }
  
  /**
   * Creates format class
   */
  private function initFormat($formatConfig)
  {
    $formatClass = $formatConfig ['class'];
    $this->format = new $formatClass();
    $parameter = array ();
    if (array_key_exists('parameter', $formatConfig))
    {
      $parameter = $formatConfig ['parameter'];
    }
    \LiveTest\initializeObject($this->format, $parameter);
  }
  
  /**
   * Writes the report.
   * 
   * @event LiveTest.Run.PostRun
   * 
   * @param Information $information
   */
  public function postRun(Information $information)
  {
    $report = new \LiveTest\Report\Report($this->writer, 
                                          $this->format, 
                                          $this->resultSet, 
                                          $this->connectionStatuses, 
                                          $information);
    $report->render();
  }
}