<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config;

use Base\Www;

/**
 * This class contains all information about the listeners and the default domain. It is used to
 * represent the config yaml and is filled by the tag system and the parse.
 *
 * @author Nils Langner
 */
class ConfigConfig implements Config
{
  /**
   * The default domain.
   * @var Uri
   */
  private $defaultDomain;

  /**
   * The listeners.
   * @var array
   */
  private $listeners = array ();

  /**
   * Sets the default domain
   *
   * @param Www\Uri $uri
   */
  public function setDefaultDomain(Www\Uri $uri)
  {
    $this->defaultDomain = $uri;
  }

  /**
   * Adds a listener to this configuration.
   *
   * @param string $name
   * @param string $className
   * @param array $parameters
   */
  public function addListener($name, $className, array $parameters, $priority)
  {
    $this->listeners[$name] = array ('className' => $className, 'parameters' => $parameters, 'priority' => $priority);
  }

  /**
   * Returns the default domain.
   *
   * @return Uri
   */
  public function getDefaultDomain( )
  {
    return $this->defaultDomain;
  }

  /**
   * Return a list of listerns.
   *
   * @return array
   */
  public function getListeners( )
  {
    return $this->listeners;
  }

  public function __toString()
  {
    return 'config';
  }
}