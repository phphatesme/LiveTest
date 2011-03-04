<?php

namespace Unit\LiveTest\Config\Tags\Config;

use LiveTest\Config\Tags\Config\Http;
use LiveTest\Config\Parser\Parser;
use LiveTest\Config\ConfigConfig;

class HttpTest extends \PHPUnit_Framework_TestCase
{
  
  public function testSetListener()
  {
    $config = new ConfigConfig();
	$http = new Http(array(), $config, new Parser('/'));
	$http->process();
	
	$listeners = $config->getListeners();
	
	$this->assertEquals($listeners['httpListener']['className'], 'LiveTest\Listener\Http\ClientConfiguration');
  }
  
}