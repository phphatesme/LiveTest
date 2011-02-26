<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser;
use LiveTest\Config\TestSuiteConfig;

class Pages extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    $config->doNotInherit();
    $config->includePages($parameters);
  }
}