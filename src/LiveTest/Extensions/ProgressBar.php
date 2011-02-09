<?php

namespace LiveTest\Extensions;

use LiveTest\TestRun\Information;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Properties;
use Base\Http\Response;

use LiveTest\Extensions\Extention;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class ProgressBar implements Extension
{
  const LINE_BREAK_AT = 70;
  
  private $counter = 0;
  
  public function __construct($runId, Zend_Config $config = null, $arguments = null)
  {
  }
  
  public function preRun(Properties $properties)
  {
  }
  
  public function handleConnectionStatus(ConnectionStatus $status)
  {
    if ($status->getType() == ConnectionStatus::ERROR)
    {
      $this->echoChar('E');
    }
  }
  
  public function handleResult(Result $result, Response $response)
  {
    switch ($result->getStatus())
    {
      case Result::STATUS_SUCCESS :
        $this->echoChar('*');
        break;
      case Result::STATUS_FAILED :
        $this->echoChar('f');
        break;
      case Result::STATUS_ERROR :
        $this->echoChar('e');
        break;
    }
  }
  
  private function echoChar($char)
  {
    if ($this->counter == 0)
    {
      echo '  Running: ';
    }
    
    if ($this->counter % self::LINE_BREAK_AT == 0 && $this->counter != 0)
    {
      echo "\n           ";
    }
    echo $char;
    $this->counter++;
  }
  
  public function postRun(Information $information)
  {
  }
}