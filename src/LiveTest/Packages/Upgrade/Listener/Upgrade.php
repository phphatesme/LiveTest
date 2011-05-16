<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Upgrade\Listener;

use Zend\Http\Client\Adapter\Curl;
use Zend\Http\Client;

use phmLabs\Components\Annovent\Event\Event;

use LiveTest\Listener\Base;

/**
 * This listener adds the --check-upgrade argument to check for a newer version
 * of LiveTest.
 *
 * @author Nils Langner
 *
 */
class Upgrade extends Base
{
  /**
   * The url where the latest stable version number can be found
   * @var string
   */
  const PHM_API = 'http://livetest.phmlabs.com/api/version';

  /**
   * This function checks if a newer version of livetest is avaiable.
   *
   * @Event("LiveTest.Runner.Init")
   *
   * @param array $arguments
   * @param Event $event
   */
  public function doUpgradeCheck($arguments, Event $event)
  {
    if (array_key_exists('check-upgrade', $arguments))
    {
      echo '  Checking for upgrade (current version ' . LIVETEST_VERSION . '): ';

      $zend = new Client(self::PHM_API);
      $zend->setAdapter(new Curl());

      $latestStable = trim($zend->request()->getBody());

      if( version_compare(LIVETEST_VERSION, $latestStable, '<' ))
      {
        echo 'Newer version found (latest stable: '.$latestStable.").\n".
             '                                                Please visit livetest.www.phmlabs.com for more information.';
      }
      else
      {
        echo 'No newer version found (latest stable: '.$latestStable.')';
      }

      $event->setProcessed();
    }
  }
}