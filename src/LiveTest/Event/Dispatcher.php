<?php

namespace LiveTest\Event;

use LiveTest\Config\ConfigConfig;

use Annovent\Event\Dispatcher as AnnoventDispatcher;

class Dispatcher extends AnnoventDispatcher
{
  public function registerListenersByConfig(ConfigConfig $config, $runId)
  {
    foreach ( $config->getListeners() as $listener )
    {
      $className = $listener['className'];
      $listenerObject = new $className($runId, $this);
      \LiveTest\initializeObject($listenerObject, $listener['parameters']);
      $this->registerListener($listenerObject);
    }
  }
}