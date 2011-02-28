<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser;

class TestSuite extends Base
{
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    $this->getParser()->parse($parameters, $config);
  }
}