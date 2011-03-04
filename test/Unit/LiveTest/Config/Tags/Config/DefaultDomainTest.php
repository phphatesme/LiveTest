<?php

namespace Unit\LiveTest\Config\Tags\Config;

use LiveTest\Config\Tags\Config\DefaultDomain;
use LiveTest\Config\Parser\Parser;
use LiveTest\Config\ConfigConfig;

class DefaultDomainTest extends \PHPUnit_Framework_TestCase
{
  
  public function testSetDefaultDomain()
  {
    $domain = 'http://test.test.test';
    $config = new ConfigConfig();
	$defaultDomain = new DefaultDomain($domain, $config, new Parser('/'));
	$defaultDomain->process();
	$this->assertEquals($config->getDefaultDomain()->toString(), $domain);
  }
  
}