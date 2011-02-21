<?php

namespace Annovent\Event;

class Event
{
  private $name;
  private $parameters;
  
  public function __construct($name, array $namedParameters = null)
  {
    $this->name = $name;
    $this->parameters = $namedParameters;
  }
  
  public function getName()
  {
    return $this->name;
  }
  
  public function getParameters( )
  {
    return $this->parameters;
  }
}