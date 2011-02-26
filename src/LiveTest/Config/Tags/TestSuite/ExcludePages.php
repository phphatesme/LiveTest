<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuiteConfig;

class ExcludePages extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    $config->excludePages($parameters);
  }
}