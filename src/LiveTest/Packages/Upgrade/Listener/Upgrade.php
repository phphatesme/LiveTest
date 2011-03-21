<?php

namespace LiveTest\Packages\Upgrade\Listener;

use Zend\Http\Client\Adapter\Curl;

use Zend\Http\Client;

use phmLabs\Components\Annovent\Event\Event;

use LiveTest\Listener\Base;

class Upgrade extends Base
{
  const PHM_API = 'http://www.phmlabs.com/livetest/api/version';

  /**
   * @Event("LiveTest.Runner.Init")
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
             '                                                Please visit www.phmlabs.com/livetest for more information.';
      }
      else
      {
        echo 'No newer version found (latest stable: '.$latestStable.')';
      }

      $event->setProcessed();
    }
  }
}