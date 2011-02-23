<?php

namespace LiveTest\Config\Tags;

class IncludePages extends Base
{
  public function process()
  {
    $config = $this->getConfig();

    foreach ($this->getParameters() as $page)
    {
      $config->includePage($page);
    }
    return $config;
  }
}