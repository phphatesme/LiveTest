<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Config;

class IncludePages extends Base
{
  protected function doProcess(Config $config, array $parameters)
  {
    $config->includePages($parameters);
  }
}