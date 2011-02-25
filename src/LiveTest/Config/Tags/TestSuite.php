<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

class TestSuite extends Base
{
  protected function doProcess(Config $config, array $parameters)
  {
    $this->getParser()->parse($parameters, $config);
  }
}