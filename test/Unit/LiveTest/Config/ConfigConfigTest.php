<?php

namespace Test\Unit\LiveTest\Config;

use LiveTest\Config\Tags\Config\DateDefaultTimezone;

use LiveTest\Config\Parser\Parser;

use LiveTest\Config\ConfigConfig;
use Base\Www\Uri;

class ConfigConfigTest extends \PHPUnit_Framework_TestCase
{
  public function testSetDefaultDomain()
  {
    $domain = new Uri('http://www.phphatesme.com');

    $config = new ConfigConfig();
    $config->setDefaultDomain($domain);

    $defaultDomain = $config->getDefaultDomain();
    $this->assertEquals($domain, $defaultDomain);
  }
  
  public function testAddListener()
  {
    $config = new ConfigConfig();
    $config->addListener( 'MyName', 'MyClassName', array( 'foo' => 'bar' ));

    $listeners = $config->getListeners();

    $this->assertArrayHasKey('MyName', $listeners);
    $listener = $listeners['MyName'];

    $this->assertEquals('MyClassName', $listener['className']);
    $this->assertArrayHasKey('foo', $listener['parameters']);
  }
  
  public function testSetDateDefaultTimezone()
  {
    $timezone = 'Europe/Paris';
	$dateDefault = new DateDefaultTimezone($timezone, new ConfigConfig(), new Parser('/'));
	$dateDefault->process();
	$this->assertEquals($timezone, @date_default_timezone_get());
  }
  
  /**
     * @expectedException \InvalidArgumentException
  */
  public function testSetDateDefaultTimezoneException()
  {
    $timezone = '';
	$dateDefault = new DateDefaultTimezone($timezone, new ConfigConfig(), new Parser('/'));
	$dateDefault->process();
  }
}