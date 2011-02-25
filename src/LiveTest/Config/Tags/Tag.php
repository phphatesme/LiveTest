<?php

namespace LiveTest\Config\Tags;

use LiveTest\Config\Parser;
use LiveTest\Config\Config;

interface Tag
{
  public function __construct(array $configParameters, Config $config, Parser $parser);
  public function process();
}