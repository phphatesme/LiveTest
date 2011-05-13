<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Core\Listeners;

use LiveTest\Listener\Base;

use phmLabs\Components\Annovent\Event\Event;

/**
 * @author Nils Langner
 */
class Preconditions extends Base
{
  /**
   * @Event("LiveTest.Runner.Init")
   */
  public function runnerInit(Event $event)
  {
    if (!function_exists('curl_version'))
    {
      echo "  The mandatory cURL library (http://php.net/manual/de/book.curl.php) was not found.\n";
      echo "  LiveTest will not work without cURL support.";
			$event->setProcessed();  
    }
  }
}