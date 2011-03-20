<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Http\Listeners;

use LiveTest\Listener\Base;

use Base\Http\Client\Client;

/**
 * This listener is used to manipulate the http client configuration.
 *
 * @author Nils Langner
 */
class ClientConfiguration extends Base
{
  private $timeout;

  /**
   * This function sets the timeout of the http client.
   *
   * @param int $timeout the http client time out in seconds
   */
  public function init($timeout)
  {
    $this->timeout = $timeout;
  }

  /**
   * This function sets the timeout for the http client.
   *
   * @Event("LiveTest.Runner.InitHttpClient")
   *
   * @param ConnectionStatus $status
   */
  public function initHttpClient(Client $client)
  {
    $client->setTimeout($this->timeout);
  }
}