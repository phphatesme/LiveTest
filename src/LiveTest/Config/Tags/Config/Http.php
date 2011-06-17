<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\Config;

use LiveTest\Config\ConfigConfig;

/**
 * This tag is a shortcut for the LiveTest\Listener\Http\ClientConfiguration listener.
 *
 * @example
 *  Http:
 *   timeout: 60
 *
 * @author Nils Langner
 */
class Http extends Base
{
  /**
   * @see LiveTest\Config\Tags\Config.Base::doProcess()
   */
  protected function doProcess(ConfigConfig $config, $parameters)
  {
    $config->addListener('httpListener', 'LiveTest\Packages\Http\Listeners\ClientConfiguration', $parameters);
  }
}