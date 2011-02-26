<?php

namespace LiveTest\Config\Tags\Config;

use LiveTest\Config\ConfigConfig;

class Listener extends Base
{
  protected function doProcess(ConfigConfig $config, $parameters)
  {
    foreach ( $parameters as $name => $listener )
    {
      if ($listener['class'] == '')
      {
        throw new \Exception('The class name for the "' . $name . '" listener is missing. Please check your configuration.');
      }
      if (!array_key_exists('parameter', $listener))
      {
        $listener['parameter'] = array ();
      }
      $config->addListener($name, $listener['class'], $listener['parameter']);
    }
  }
}