<?php

namespace Base\Cli;

// @todo Mandatory-Check von Runner und TestCase irgendwie vereinheitlichen

abstract class ArgumentRunner implements Runner
{
  private $commandLineArguments = array();
  private $arguments = array();
  
  protected $mandatoryArguments = array();
  
  public function __construct(array $arguments)
  {
    $this->arguments = $arguments;
    $this->checkMandatoryArguments();
  }
  
  protected function checkMandatoryArguments()
  {
    foreach ($this->mandatoryArguments as $mandatoryArgument)
    {
      if (!$this->hasArgument($mandatoryArgument))
      {
        throw new MissingArgumentException('The mandatory argument "' . $mandatoryArgument . '" is missing', null, null, $mandatoryArgument);
      }
    }
  }
  
  protected function hasArgument($argumentName)
  {
    return array_key_exists($argumentName, $this->arguments);
  }
  
  protected function getArgument($argumentName)
  {
    if (!$this->hasArgument($argumentName))
    {
      throw new Exception('The argument "' . $argumentName . '" is not existing.');
    }
    return $this->arguments[$argumentName];
  }
  
  protected function getArguments()
  {
    return $this->arguments;
  }
}