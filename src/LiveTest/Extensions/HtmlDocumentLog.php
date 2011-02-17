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
  
  /**
   * This function stores the log_path and if neccessary it creates the path.
   * 
   * @param string $runId
   * @param \Zend_Config $config
   * @param array $arguments
   */
  public function __construct($runId,\Zend_Config $config = null, $arguments = null)
  {
    $this->logPath = $config->log_path . '/' . $runId . '/';
    if (!file_exists($this->logPath))
    {
      mkdir($this->logPath);
    }
  }
  
  /**
   * not used
   * 
   * @param Properties $properties
   */
  public function preRun(Properties $properties)
  {
  
  }
  
  /**
   * This function stores the html document in a specified directory
   * 
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response)
  {
    $filename = $this->logPath . '/' . urlencode($result->getUrl());
    file_put_contents($filename, $response->getBody());
  }
  
  /**
   * not used
   * 
   * @param ConnectionStatus $status
   */
  public function handleConnectionStatus(ConnectionStatus $status)
  {
  
  }
  
  /**
   * not used
   * 
   * @param Information $information
   */
  public function postRun(Information $information)
  {
  }
}