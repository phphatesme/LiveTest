<?php

namespace LiveTest\Config\Tags\TestSuite;

use LiveTest\Config\Parser\Parser;
use LiveTest\Config\TestSuiteConfig;

interface Tag
{
  public function __construct(array $configParameters, TestSuiteConfig $config, Parser $parser);
  public function process();
}