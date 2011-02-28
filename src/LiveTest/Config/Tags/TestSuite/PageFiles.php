<?php

namespace LiveTest\Config\Tags\TestSuite;

class PageFiles extends Base
{
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    $config->doNotInherit();
    foreach ($parameters as $file)
    {
      $config->includePages(file($config->getBaseDir() . '/' . $file));
    }
  }
}