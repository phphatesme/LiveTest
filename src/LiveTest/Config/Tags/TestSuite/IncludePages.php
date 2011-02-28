<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuite as TestSuiteConfig;

class IncludePages extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    $config->includePages($parameters);
  }
}