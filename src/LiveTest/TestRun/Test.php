<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use Base\Cli\WrongTypeException;

class Test
{
  /**
   * Dataholder for a class
   * @var Object
   */
  private $className;
  
  /**
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
   * @param String $class
   * @param \Zend_Config $parameter
   */
  public function __construct( $name, $className, \Zend_Config $parameter)
  {    
    if( !is_string( $name ) )
    {
      throw new WrongTypeException('Parameter name has to be a string');
    }
    
   if( !is_string( $className ) )
    {
      throw new WrongTypeException('Parameter className has to be a string');
    }
    
    $this->className = $className;
    $this->name = $name;
    $this->parameter = $parameter;
  }

  public function getClassName()
  {
    return $this->className;
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