<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser;


class Pages extends Base
{
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    $config->doNotInherit();
    $config->includePages($parameters);
  }
}