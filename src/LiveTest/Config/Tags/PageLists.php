<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Config;

use Base\Config\Yaml;

class PageLists extends Base
{
  protected function doProcess(Config $config, array $parameters)
  {
    foreach ($parameters as $file)
    {
      $yaml = new Yaml($config->getBaseDir() . '/' . $file);
      $this->getParser()->parse( $yaml->toArray( ), $config );
    }
  }
}