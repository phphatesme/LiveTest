<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser\Parser;
use LiveTest\Config\Config;

abstract class Base implements Tag
{
  private $configParameters;
  private $config;
  private $parser;

  public function __construct(array $configParameters, Config $config, Parser $parser)
  {
    $this->configParameters = $configParameters;
    $this->config = $config;
    $this->parser = $parser;
  }

  protected function getParser()
  {
    return $this->parser;
  }

  final public function process()
  {
    return $this->doProcess($this->config, $this->configParameters);
  }

  abstract protected function doProcess(Config $config, array $parameters);
}