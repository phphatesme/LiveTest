<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Config;

class PageFiles extends Base
{
  protected function doProcess(Config $config, array $parameters)
  {
    $config->doNotInherit();

    foreach ($parameters as $file)
    {
      $config->includePages(file($config->getBaseDir() . '/' . $file));
    }
  }
}