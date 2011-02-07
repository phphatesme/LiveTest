<?php

namespace LiveTest\TestRun;

use Base\Cli\WrongTypeException;

class Test
{
  /**
   * 
   * Dataholder for a class
   * @var Object
   */
  private $class;
  
  /**
   * 
   * Name
   * @var String
   */
  private $name;
  
  /**
   * 
   * Properties of a test
   * @var \ArrayIterator
   */
  private $parameter;
  
  /**
   * 
   * Constructor for Test
   * @param String $name
   * @param Object $class
   * @param array $parameter
   */
  public function __construct( $name, $class, array $parameter)
  {
    
    if( !is_object( $class ) )
    {
      throw new WrongTypeException('Parameter class has to be a object');
    }
    
    if( !is_string( $name ) )
    {
      throw new WrongTypeException('Parameter name has to be a string');
    }
    
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