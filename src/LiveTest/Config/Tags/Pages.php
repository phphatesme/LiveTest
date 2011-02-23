<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

class Pages extends Base
{
  public function process()
  {
    $config = $this->getConfig();
    $config->doNotInherit();

    foreach ($this->getParameters() as $page)
    {
      $config->includePage($page);
    }
    return $config;
  }
}