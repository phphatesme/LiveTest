<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser\Parser;

abstract class Base implements Tag
{
  private $configParameters;
  private $config;
  private $parser;

  public function __construct(array $configParameters, \LiveTest\Config\TestSuite $config, Parser $parser)
  {
    $this->configParameters = $configParameters;
    $this->config = $config;
    $this->parser = $parser;
  }

  /**
   * @return Parser
   */
  protected function getParser()
  {
    return $this->parser;
  }

  final public function process()
  {
    return $this->doProcess($this->config, $this->configParameters);
  }

  abstract protected function doProcess(\LiveTest\Config\TestSuite $config, array $parameters);
}