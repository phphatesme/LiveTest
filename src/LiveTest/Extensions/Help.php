<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;

use Base\Http\ConnectionStatus;
use Base\Http\Response;

use LiveTest\TestRun\Properties;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

/**
 * This extension is used to print the help content if the --help argument is set
 * 
 * @author Nils Langner
 */

class Help implements Extension
{
  /**
   * The command line arguments
   * 
   * @var string[]
   */
  private $arguments;
  
  /**
   * This template that contains the help text
   * @var string The filename. Relative to __DIR__. 
   */
  private $template = 'Help/template.tpl'; 
  
  /**
   * @see LiveTest\Extensions\Extension::__construct()
   */
  public function __construct($runId, \Zend_Config $config = null, $arguments = null)
  {
    $this->arguments = $arguments;
  }
  
  /**
   * This function echoes the global help if the --help command line argument is set
   * 
   * @see LiveTest\Extensions\Extension::preRun()
   * 
   * @param Properties $properties
   */
  public function preRun(Properties $properties)
  {
    if (array_key_exists('help', $this->arguments) || count( $this->arguments ) == 0)
    {
      echo file_get_contents( __DIR__.DIRECTORY_SEPARATOR.$this->template );
      return false;
    }
    return true;
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
   * @param Result $result
   * @param Response $response
   */
  public function handleResult(Result $result, Response $response)
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