<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\TestSuiteConfig;

class PageFiles extends Base
{
  protected function doProcess(TestSuiteConfig $config, array $parameters)
  {
    $config->doNotInherit();
    foreach ($parameters as $file)
    {
      $config->includePages(file($config->getBaseDir() . '/' . $file));
    }
  }
}