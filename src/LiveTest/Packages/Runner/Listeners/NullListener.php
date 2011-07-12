<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Runner\Listeners;

use LiveTest\Listener\Base;

/**
 * This listener is used to echo a status bar with all important collected information
 * of the test run.
 *
 * @author Nils Langner
 */
class NullListener extends Base
{
  /**
   * @Event( "No.Event" )
   */
  public function doNothingNow()
  {

  }
}