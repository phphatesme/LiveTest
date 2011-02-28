<?php

namespace LiveTest\Config\Tags\Config;

use Base\Www\Uri;

use LiveTest\Config\ConfigConfig;

class DefaultDomain extends Base
{
  protected function doProcess(ConfigConfig $config, $parameters)
  {
    $config->setDefaultDomain(new Uri($parameters));
  }
}