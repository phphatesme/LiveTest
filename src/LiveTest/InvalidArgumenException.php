<?php

namespace LiveTest;

class InvalidArgumentException extends \LiveTest\TestCase\Exception
{
  private $argument;
  
  public function __construct($message, $argument, $code = null, $previous = null)
  {
    $this->argument = $argument;
    parent::__construct($message, $code, $previous);
  }
  
  public function getArgument()
  {
    return $this->argument;
  }
}