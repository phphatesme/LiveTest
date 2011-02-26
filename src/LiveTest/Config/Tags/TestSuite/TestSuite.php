<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser;
use LiveTest\Config\TestSuiteConfig;

class TestSuite extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    $this->getParser()->parse($parameters, $config);
  }
}