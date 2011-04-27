<?php

namespace Unit\LiveTest\Cli;

use \LiveTest\Cli\Exception;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{
  /**
   * @expectedException \LiveTest\Cli\Exception
   */
  public function testCliException()
  {
    throw new \LiveTest\Cli\Exception;
  }
  
}