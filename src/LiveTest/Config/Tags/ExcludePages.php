<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

class ExcludePages extends Base
{
  public function process()
  {
    $config = $this->getConfig();

    foreach ($this->getParameters() as $page)
    {
      $config->excludePage($page);
    }
    return $config;
  }
}