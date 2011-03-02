<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser\Parser;

interface Tag
{
  public function __construct(array $configParameters, \LiveTest\Config\TestSuite $config, Parser $parser);
  public function process();
}