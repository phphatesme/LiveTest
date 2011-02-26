<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuiteConfig;

class IncludePages extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    $config->includePages($parameters);
  }
}