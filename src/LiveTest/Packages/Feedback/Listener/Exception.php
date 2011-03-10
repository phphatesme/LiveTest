<?php

namespace Feedback\Listener;

use LiveTest\TestRun\Properties;
use LiveTest\Listener\Base;

class Exception extends Base
{
  /**
   * This function echoes the default domian, start time, number of uri and number of tests.
   *
   * @event LiveTest.Run.PreRun
   *
   * @param Properties $properties
   */
  public function preRun(Properties $properties)
  {
    throw new \LiveTest\Exception( 'Feedback test exception!');
  }
}