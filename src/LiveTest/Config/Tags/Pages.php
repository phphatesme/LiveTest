<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

class Pages extends Base
{
  protected function doProcess(Config $config, array $parameters)
  {
    $config->doNotInherit();
    $config->includePages($parameters);
  }
}