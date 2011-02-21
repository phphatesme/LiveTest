<?php

namespace Base\Cli;

class MissingArgumentException extends Exception
{
  private $argument;
  
  public function __construct($message, $code, $previous, $argument)
  {
    parent::__construct($message, $code, $previous);
    $this->argument = $argument;
  }
  
  public function getArgument( )
  {
    return $this->argument;
  }
}