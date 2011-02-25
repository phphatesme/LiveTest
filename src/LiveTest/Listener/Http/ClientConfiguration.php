<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Listener\Http;

use LiveTest\Listener\Base;

use Base\Http\Client\Client;

/**
 * @author Nils Langner
 */
class ClientConfiguration extends Base
{
  private $timeout;

  /**
   * @param int $timeout the http client time out in seconds
   */
  public function init($timeout)
  {
    $this->timeout = $timeout;
  }

  /**
   * @event LiveTest.Runner.InitHttpClient
   *
   * @param ConnectionStatus $status
   */
  public function handleConnectionStatus(Client $client)
  {
    $client->setTimeout($this->timeout);
  }
}