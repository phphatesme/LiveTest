<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

class PageFiles extends Base
{
  public function process()
  {
    $config = $this->getConfig();
    $config->doNotInherit();

    $parameters = $this->getParameters();

    foreach ($this->getParameters() as $file)
    {
      $config->includePages( file( $config->getBaseDir().'/'.$file ) );
    }
    return $config;
  }
}