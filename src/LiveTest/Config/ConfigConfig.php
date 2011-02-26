<?php

namespace LiveTest\Config;

use Base\Www;

class ConfigConfig implements Configuration
{
  private $defaultDomain;
  
  private $listeners = array ();
  
  public function setDefaultDomain(Www\Uri $uri)
  {
    $this->defaultDomain = $uri;
  }
  
  public function addListener($name, $className, $parameters)
  {
    $this->listeners[$name] = array ('className' => $className, 'parameters' => $parameters);
  }

  public function getDefaultDomain( )
  {
    return $this->defaultDomain;
  }
  
  public function getListeners( )
  {
    return $this->listeners;
  }
}