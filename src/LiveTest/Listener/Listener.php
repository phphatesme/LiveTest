<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Listener;

use Annovent\Event\Dispatcher;

/**
 * The listener interface. Listeners are called via the internal event system.
 * Annotations are used to register to special events. For more information see
 * https://github.com/phphatesme/Annovent
 * 
 * @author Nils Langner
 *
 */
interface Listener extends \Annovent\Event\Listener
{
  /**
   * The standardized constructor.
   * 
   * @param string $runId
   * @param Dispatcher $eventDispatcher
   */
  public function __construct($runId, Dispatcher $eventDispatcher);
}