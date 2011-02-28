<?php

namespace LiveTest\Config\Tags\TestSuite;



class ExcludePages extends Base
{
  protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters)
  {
    $config->excludePages($parameters);
  }
}