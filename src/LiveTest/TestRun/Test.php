<?php

namespace LiveTest\TestRun;

class Test
{
  private $class;
  private $name;
  private $parameter;
  
  public function __construct( $name, $class, $parameter)
  {
    $this->class = $class;
    $this->name = $name;
    $this->parameter = $parameter;
  }

  public function getClass()
  {
    return $this->class;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getParameter()
  {
    return $this->parameter;
  }
}