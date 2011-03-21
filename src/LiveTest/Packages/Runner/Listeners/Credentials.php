<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Runner\Listeners;

use LiveTest\Event\Dispatcher;

use LiveTest\Listener\Base;
use LiveTest\TestRun\Properties;

/**
 * @author Nils Langner
 */
class Credentials extends Base
{
  /**
   * @Event("LiveTest.Runner.Init")
   */
  public function runnerInit()
  {
    echo "\nLiveTest " . LIVETEST_VERSION . " by Nils Langner & Mike Lohmann\n";
  }
}