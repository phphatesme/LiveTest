<?php

namespace LiveTest\TestCase;

use LiveTest\TestCase\TestCase;

// @todo diese Funktionalit�t k�nnte auch von Au�en passieren. Dann m�sste hasParameter aber public sein. Andererseits 
//       sollte die Klasse auch selbst f�r ihre Konsistenz sorgen-

abstract class ConfigurableTestCase implements TestCase
{
  private $parameter;
  protected $mandatoryParameter = array();
  
  public function __construct(array $parameter)
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