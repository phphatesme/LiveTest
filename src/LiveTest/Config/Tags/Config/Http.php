<?php

namespace LiveTest\Config\Tags\Config;

use LiveTest\Config\ConfigConfig;

class Http extends Base
{
  protected function doProcess(ConfigConfig $config, $parameters)
  {
    $config->addListener('', 'LiveTest\Listener\Http\ClientConfiguration', $parameters);
  }
}