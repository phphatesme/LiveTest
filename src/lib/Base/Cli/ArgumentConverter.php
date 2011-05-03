<?php

namespace Base\Cli;

class ArgumentConverter
{
  private $arguments = array();
  private $commandLineArguments = array();
  private $argumentToken;

  public function __construct($commandLineArray, $argumentToken = '--')
  {
    $this->argumentToken = $argumentToken;
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

  public function getArgument( $argumentName )
  {
    // @todo use has argument before
    return $this->arguments[$argumentName];
  }

  private function extractArguments()
  {
    for($i = 0; $i < count($this->commandLineArguments); $i++)
    {
      if (substr($this->commandLineArguments[$i], 0, 2) == $this->argumentToken)
      {
        if (substr($this->commandLineArguments[$i], 2) != '')
        {
          if (!array_key_exists($i + 1, $this->commandLineArguments))
          {
            $value = '';
          }
          else if (substr($this->commandLineArguments[$i + 1], 0, 2) == $this->argumentToken)
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