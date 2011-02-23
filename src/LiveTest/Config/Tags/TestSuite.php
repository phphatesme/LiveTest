<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

class TestSuite implements Tag
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

  public function process( )
  {
    $this->parser->parse(($this->configParameters), $this->config);
    return $this->config;
  }
}