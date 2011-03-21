<?php

/**
 * @todo add documentation & license boilerplate
 */
namespace Feedback\Listener;

use LiveTest\TestRun\Properties;
use LiveTest\Listener\Base;

class Exception extends Base
{
  /**
   * @event LiveTest.Run.PreRun
   *
   * @param Properties $properties
   */
  public function preRun(Properties $properties)
  {
    throw new \LiveTest\Exception( 'Feedback test exception!');
  }
}