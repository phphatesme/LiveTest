<?php

namespace LiveTest\Packages\Upgrade\Listener;

use LiveTest\Listener\Base;

class Upgrade extends Base
{
  /**
   * @Event("LiveTest.Runner.Init")
   */
  public function doUpgradeCheck($arguments)
  {
    if (array_key_exists('check-upgrade', $arguments))
    {
      echo '  Checking for upgrade (current version '.LIVETEST_VERSION.'): ';
      return false;
    }
  }
}