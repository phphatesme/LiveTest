<?php

namespace LiveTest\Listener;

use phmLabs\Components\Annovent\Event\Event;

class Greedy extends Base
{
  /**
   * @Event("*")
   */
  public function listenAll(Event $event)
  {
    echo 'Event: ' . $event->getName() . "\n";
  }
}
