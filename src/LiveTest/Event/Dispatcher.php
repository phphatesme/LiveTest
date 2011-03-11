<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Event;

use phmLabs\Components\Annovent\Event\Simple;

use LiveTest\Config\ConfigConfig;

use phmLabs\Components\Annovent\Dispatcher as AnnoventDispatcher;

/**
 * This dispatcher is a standard Annovent dispatcher with the possibility to register
 * listeners using a ConfigConfig object.
 *
 * @author Nils Langner
 */
class Dispatcher extends AnnoventDispatcher
{
  /**
   * This function is used to register listeners using a global configuration file
   *
   * @param ConfigConfig $config
   * @param string $runId
   */
  public function registerByConfig(ConfigConfig $config, $runId)
  {
    foreach ( $config->getListeners() as $listener )
    {
      $className = $listener['className'];
      if (!class_exists($className))
      {
        throw new \LiveTest\ConfigurationException('Listener not found (' . $className . ').');
      }
      $listenerObject = new $className($runId, $this);
      \LiveTest\Functions::initializeObject($listenerObject, $listener['parameters']);
      $this->register($listenerObject);
    }
  }

  public function simpleNotify($name, array $namedParameters = array())
  {
    $event = new Simple($name, $namedParameters);
    return $this->notify($event, $namedParameters);
  }
}