<?php

namespace Annovent\Event;

class Event
{
  private $name;
  private $parameters;
  private $isProcessed = false;

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

  public function setProcessed( )
  {
    $this->isProcessed = true;
  }

  public function isProcessed( )
  {
    return $this->isProcessed;
  }
}