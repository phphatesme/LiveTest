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
 * This tag adds the given listeners to the configuration.
 *
 * @example
 *  Listener:
 *   HtmlLogger:
 *    class: LiveTest\Listener\HtmlDocumentLog
 *    priority: 5 (between 10 and -10, standard = 0)
 *    parameter:
 *     logPath: logs/
 *
 * @author Nils Langner
 */
class Listener extends Base
{
  /**
   * @see LiveTest\Config\Tags\Config.Base::doProcess()
   */
  protected function doProcess(ConfigConfig $config, $parameters)
  {
    foreach ( $parameters as $name => $listener )
    {
      if (!array_key_exists('class', $listener) || $listener['class'] == '')
      {
        throw new \Exception('The class name for the "' . $name . '" listener is missing. Please check your configuration.');
      }
      if (!array_key_exists('priority', $listener))
      {
        $listener['priority'] = 0;
      }
      if (!array_key_exists('parameter', $listener))
      {
        $listener['parameter'] = array ();
      }
      $config->addListener($name, $listener['class'], $listener['parameter'], $listener['priority']);
    }
  }
}