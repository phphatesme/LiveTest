<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Packages\Runner\Listeners;

use Base\Www\Uri;
use LiveTest\Config\ConfigConfig;
use LiveTest\Listener\Base;
use phmLabs\Components\Annovent\Event\Event;

/**
 * This extension is used to change/set the default domain by using the command line parameter --defaultDomain.
 * It must be registred as core listener as the events to react on are very early. 
 *
 * @author Nils Langner
 */
class DefaultDomain extends Base
{
	/**
	 * The default domain
	 * @var string
	 */
  private $defaultDomain;
  
  /**
   * This function extracts the defaultDomain from  the command line parameters and stores it.
   * 
   * @Event("LiveTest.Runner.InitCore")
   *
   * @param array $arguments
   */
  public function runnrCoreInit(array $arguments, Event $event)
  {
    if (array_key_exists('defaultDomain', $arguments))
    {
      $this->defaultDomain = new Uri($arguments['defaultDomain']);
    }
  }
  
  /**
   * This function sets the defaultDomain (if set) in the current config
   * 
   * @Event("LiveTest.Runner.ConfigInitialized")
   */
  public function runnerConfigInitialized(ConfigConfig $config)
  {
    if (!is_null($this->defaultDomain))
    {
      $config->setDefaultDomain($this->defaultDomain);
    }
  }
}