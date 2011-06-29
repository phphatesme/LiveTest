<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuite as TestSuiteConfig;

/**
 * This tag is used to add a PageManupulator to a given config. This is needed
 * if a test case wants to manipulate the url of a pageRequest.

 * @author Nils Langner
 */
class PageManipulators extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(TestSuiteConfig $config, $manipulators)
  {
    foreach ( $manipulators as $manipulator )
    {
      $manipulatorObject = new $manipulator();
      $config->addPageManipulator($manipulatorObject);
    }
  }
}