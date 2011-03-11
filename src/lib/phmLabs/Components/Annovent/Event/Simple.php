<?php

namespace phmLabs\Components\Annovent\Event;

class Simple implements Event
{
  private $parameters;
  private $name;
  private $isProcessed = false;
  private $chainCompleted = true;

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

  public function interruptChain( )
  {
    $this->chainCompleted = false;
  }

  public function isChainCompleted( )
  {
    return $this->chainCompleted;
  }

  public function setProcessed()
  {
    $this->isProcessed = true;
  }

  public function isProcessed()
  {
    return $this->isProcessed;
  }
}