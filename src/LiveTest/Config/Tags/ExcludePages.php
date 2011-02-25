<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Config;

class ExcludePages extends Base
{
  protected function doProcess(Config $config, array $parameters)
  {
    $config->excludePages($parameters);
  }
}