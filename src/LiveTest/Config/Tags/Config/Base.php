<?php

namespace LiveTest\Config\Tags\Config;

use LiveTest\Config\Parser\Parser;
use LiveTest\Config\ConfigConfig;

abstract class Base
{
  private $configParameters;
  private $config;
  private $parser;

  public function __construct($configParameters, ConfigConfig $config, Parser $parser)
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

  abstract protected function doProcess(ConfigConfig $config, $parameters);
}