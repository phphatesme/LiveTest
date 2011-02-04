<?php

namespace Base\Cli;

class ArgumentConverter
{
  private $arguments = array();
  private $commandLineArguments = array();
  
  public function __construct($commandLineArray, $argumentToken = '--')
  {
    $this->commandLineArguments = $commandLineArray;
    $this->extractArguments();
  }
  
  public function hasArgument( $argumentName )
  {
    return array_key_exists($argumentName, $this->arguments);
  }
  
  public function getArguments()
  {
    return $this->arguments;
  }
  
  private function extractArguments()
  {
    for($i = 0; $i < count($this->commandLineArguments); $i++)
    {
      // @FIXME -- hardcoded
      if (substr($this->commandLineArguments[$i], 0, 2) == '--')
      {
        if (substr($this->commandLineArguments[$i], 2) != '')
        {
          if (!array_key_exists($i + 1, $this->commandLineArguments))
          {
            $value = '';
          }
          else if (substr($this->commandLineArguments[$i + 1], 0, 2) == '--')
          {
            $value = '';
          }
          else
          {
            $value = $this->commandLineArguments[$i + 1];
          }
          $this->arguments[substr($this->commandLineArguments[$i], 2)] = $value;
        }
      }
    }
  }
}