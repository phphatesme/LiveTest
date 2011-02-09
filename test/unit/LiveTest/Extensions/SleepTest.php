<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Http\Response;

use Base\Timer\Timer;

use LiveTest\Extensions\Sleep;

use Base\Www\Uri;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class SleepTest extends \PHPUnit_Framework_TestCase
{
  private $sleepTime = 1;
  
  private $extension;
    
  protected function setUp()
  {
    $config = new \Zend_Config(array('sleep_time' => $this->sleepTime ) );
    $this->extension = new Sleep('', $config);
  }
  
  public function testHandleResult()
  {
    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Response(new \Zend_Http_Response(200, array()));
    
    $timer = new Timer();
    $this->extension->handleResult(new Result($test, Result::STATUS_SUCCESS, '', new Uri( 'http://www.example.com')), $response);
    $this->assertGreaterThanOrEqual($this->sleepTime, $timer->stop());
  }
}