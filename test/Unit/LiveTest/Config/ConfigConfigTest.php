<?php

namespace Test\Unit\LiveTest\Config;

use LiveTest\Config\Parser\Parser;

use LiveTest\Config\ConfigConfig;
use LiveTest\Config\Tags\Config\DateDefaultTimeZone;
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
  
  public function testSetDateDefaultTimeZone()
  {
    $timeZone = 'Europe/Paris';
	$dateDefault = new DateDefaultTimeZone($timeZone, new ConfigConfig(), new Parser('/'));
	$dateDefault->process();
	$this->assertEquals($timeZone, @date_default_timezone_get());
  }
  
  /**
     * @expectedException \InvalidArgumentException
  */
  public function testSetDateDefaultTimeZoneException()
  {
    $timeZone = '';
	$dateDefault = new DateDefaultTimeZone($timeZone, new ConfigConfig(), new Parser('/'));
	$dateDefault->process();
  }
}