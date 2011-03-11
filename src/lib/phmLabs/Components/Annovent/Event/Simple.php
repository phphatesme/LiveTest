<?php

namespace phmLabs\Components\Annovent\Event;

class Simple implements Event
{
  private $parameters;
  private $name;
  private $isProcessed = false;

  public function __construct($name, array $namedParameters = array())
  {
    $this->name = $name;
    $this->parameters = $namedParameters;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getParameters()
  {
    return $this->parameters;
  }

  public function setIsProcessed()
  {
    $this->isProcessed = true;
  }

  public function isProcessed()
  {
    return $this->isProcessed;
  }
}