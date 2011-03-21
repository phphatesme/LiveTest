<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Runner\Listeners;

use phmLabs\Components\Annovent\Event\Event;
use LiveTest\Listener\Base;

/**
 * This extension is used to print the help content if the --help argument is set
 *
 * @author Nils Langner
 */
class Version extends Base
{
  /**
   * This template that contains the help text
   *
   * @var string The filename. Relative to __DIR__.
   */
  private $template = 'Help/template.tpl';

  /**
   * This function echoes the global help if the --help command line argument is set
   *
   * @Event("LiveTest.Runner.Init")
   *
   * @param array $arguments
   */
  public function runnerInit(array $arguments, Event $event)
  {
    if (array_key_exists('version', $arguments))
    {
      $credentials = new Credentials($this->getRunId(), $this->getEventDispatcher());
      $event->setProcessed();
    }
  }
}