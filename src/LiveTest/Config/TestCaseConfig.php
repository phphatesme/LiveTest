<?php

namespace LiveTest\Config;

class TestCaseConfig
{
  private $className;

  private $parameters;

  private $sessionNames = array ();

  public function __construct($className, array $parameters)
  {
    $this->className = $className;
    $this->parameters = $parameters;
  }

  public function getClassName()
  {
    return $this->className;
  }

  public function getParameters()
  {
    return $this->parameters;
  }

  public function addSession($session)
  {
    $this->sessionNames[] = $session;
  }

  public function getSessionNames()
  {
    return $this->sessionNames;
  }
}