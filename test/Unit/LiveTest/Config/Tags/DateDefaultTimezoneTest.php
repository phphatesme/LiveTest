<?php

namespace Test\Unit\LiveTest\Config;

use LiveTest\Config\Tags\Config\DateDefaultTimezone;

use LiveTest\Config\Parser\Parser;

use LiveTest\Config\ConfigConfig;

class DateDefaultTimezoneTest extends \PHPUnit_Framework_TestCase
{
   
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