<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use Base\Cli\WrongTypeException;

/**
 * This class contains all information needed to create a test case for a special
 * uri.
 *
 * @author Nils Langner
 */
class Test
{
  /**
   * The name of the test class
   * @var string
   */
  private $className;

  /**
   * The name of this test
   * @var String
   */
  private $name;

  /**
   * Properties of a test
   * @var array
   */
  private $parameter;

  /**
   * Constructor for Test
   *
   * @param String $name
   * @param String $className
   * @param array $parameter
   */
  public function __construct($name, $className, array $parameter = array())
  {
    if (!is_string($name))
    {
      // @fixme this is a CLI exception
      throw new WrongTypeException('Parameter name has to be a string');
    }

    if (!is_string($className))
    {
      // @fixme this is a CLI exception
      throw new WrongTypeException('Parameter className has to be a string');
    }

    $this->className = $className;
    $this->name = $name;
    $this->parameter = $parameter;
  }

  /**
   * Returns the class name of the test case
   *
   * @return string
   */
  public function getClassName()
  {
    return $this->className;
  }

  /**
   * Returns the name of the test
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Returns the parameters for the test
   *
   * @return array
   */
  public function getParameter()
  {
    return $this->parameter;
  }
}