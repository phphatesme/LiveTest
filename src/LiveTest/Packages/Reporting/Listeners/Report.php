<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Reporting\Listeners;

use LiveTest;
use LiveTest\TestRun\Information;
use LiveTest\Listener\Base;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

use Base\Http\ConnectionStatus;
use Base\Http\Response\Response;

/**
 * This listener is used to provide all kind of reporting mechanism. Creating a report
 * is a two step task. You need to define a format (e.g Html or plain text) that will
 * create a formatted string. The second step is to define the writer. A writer takes a format
 * and writes it (e.g file writer or e-mail writer).
 *
 * @author Nils Langner
 */
class Report extends Base
{
  private $resultSet;
  private $logStatuses = array ();
  private $connectionStatuses = array ();
  private $reportOnSuccess = true;
  private $writerConfig = array ();
  private $formatConfig = array ();

  /**
   * Initializing the format, writer and define the log statuses.
   *
   * @param array $format
   * @param array $writer
   * @param array $logStatuses
   */
  public function init(array $format, array $writer, array $logStatuses = null, $reportOnSuccess = true)
  {
    $this->resultSet = new ResultSet();

    $this->logStatuses = \Base\Functions::firstNotNull($logStatuses, array (Result::STATUS_ERROR, Result::STATUS_FAILED, Result::STATUS_SUCCESS ));
    $this->reportOnSuccess = !($reportOnSuccess === 'false');

    $this->initWriter( $writer );
    $this->initFormat( $format );
  }

  /**
   * Collect all information about the connection errors.
   *
   * @Event("LiveTest.Run.HandleConnectionStatus")
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
   * @Event("LiveTest.Run.HandleResult")
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
   * Creates the writer class.
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
    \LiveTest\Functions::initializeObject($this->writer, $parameter);
  }

  /**
   * Creates format class.
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
    \LiveTest\Functions::initializeObject($this->format, $parameter);
  }

  /**
   * Writes the report. If the flag ReportOnSuccess is set to false nothing will be happen
   * if no error occurs.
   *
   * @Event("LiveTest.Run.PostRun")
   *
   * @param Information $information
   */
  public function postRun(Information $information)
  {
    if( $this->reportOnSuccess || $this->resultSet->getStatus() != Result::STATUS_SUCCESS)
    {
      $report = new \LiveTest\Packages\Reporting\Report($this->writer,
                                            $this->format,
                                            $this->resultSet,
                                            $this->connectionStatuses,
                                            $information);
      $report->render();
    }
  }
}