<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

abstract class Base implements Tag
{
  private $config;
  private $parser;
  private $configParameters;

  public function __construct(array $configParameters, Config $config, Parser $parser)
  {
    $this->config = $config;
    $this->parser = $parser;
    $this->configParameters = $configParameters;
  }

  public function getConfig( )
  {
    return $this->config;
  }

  protected function getParser( )
  {
    return $this->parser;
  }

  protected function getParameters( )
  {
    return $this->configParameters;
  }
}