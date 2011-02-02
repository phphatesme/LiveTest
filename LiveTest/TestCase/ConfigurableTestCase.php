<?php

namespace LiveTest\TestCase;

use LiveTest\TestCase\TestCase;

// @todo diese Funktionalität könnte auch von Außen passieren. Dann müsste hasParameter aber public sein. Andererseits 
//       sollte die Klasse auch selbst für ihre Konsistenz sorgen-

abstract class ConfigurableTestCase implements TestCase
{
  private $parameter;
  protected $mandatoryParameter = array();
  
  public function __construct($parameter)
  {
    $this->parameter = $parameter;
    $this->checkMandatoryParameter();
  }
  
  private function checkMandatoryParameter()
  {
    foreach ($this->mandatoryParameter as $mandatoryParameter)
    {
      if (!$this->hasParameter($mandatoryParameter))
      {
        throw new \LiveTest\Exception('Mandatory parameter "' . $mandatoryParameter . '" is missing.');
      }
    }
  }
  
  protected function hasParameter($paramName)
  {
    
    if (is_null($this->parameter))
    {
      return false;
    }
    return !is_null($this->parameter->$paramName);
  }
  
  protected function getParameter($paramName)
  {
    if (!$this->hasParameter($paramName))
    {
      throw new \LiveTest\Exception('The parameter "' . $paramName . '" does not exist.');
    }
    $parameter = $this->parameter->$paramName;
    return (string)$parameter;
  }
}