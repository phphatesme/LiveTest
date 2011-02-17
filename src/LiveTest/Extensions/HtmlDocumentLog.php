<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\Extensions\Extension;

/**
 * This extensions logs all html documents to a file. The filename is created
 * using urlencode($url). The log directory can be specified.
 * 
 * @author Nils Langner
 */

class HtmlDocumentLog implements Extension
{
  /**
   * The path were the html documents are stored.
   * 
   * @var string
   */
  private $logPath;
  private $runId;
  
  private $logStatuses = array();
  
  /**
   * This cobstructor is used to configure the log levels and to create the log path 

   * @param string $runId
   * @param Zend_Config $config
   * @param array $arguments
   */
  public function __construct($runId, \Zend_Config $config = null, $arguments = null)
  {
    $this->logPath = $config->log_path . '/' . $runId . '/';
    if (!file_exists($this->logPath))
    {
      mkdir($this->logPath);
    }
    
    if (!is_null($config->log_statuses))
    {
      $this->logStatuses = $config->log_statuses->toArray();
    }
    else
    {
      $this->logStatuses = array(Result::STATUS_ERROR,Result::STATUS_FAILED);
    }
  }
  
  /**
   * not used
   * @see LiveTest\Extensions.Extension::preRun()
   */
  public function preRun(Properties $properties)
  {
  
  }
  
  /**
   * This function writes the html documents to a specified directory
   * 
   * @see LiveTest\Extensions.Extension::handleResult()
   */
  public function handleResult(Result $result, Response $response)
  {
    if (in_array($result->getStatus(), $this->logStatuses))
    {
      $filename = $this->logPath . '/' . urlencode($result->getUrl());
      file_put_contents($filename, $response->getBody());
    }
  }
  
  /**
   * not used
   * 
   * @see LiveTest\Extensions.Extension::handleConnectionStatus()
   */
  public function handleConnectionStatus(ConnectionStatus $status)
  {
  
  }
  
  /**
   * not used
   * 
   * @see LiveTest\Extensions.Extension::postRun()
   */
  public function postRun(Information $information)
  {
  }
}