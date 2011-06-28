<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser\Parser;

interface Tag
{
  public function __construct($configParameters, \LiveTest\Config\TestSuite $config, Parser $parser);
  public function process();
}