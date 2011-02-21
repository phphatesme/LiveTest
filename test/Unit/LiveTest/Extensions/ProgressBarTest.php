<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Http\Response;

use Base\Www\Uri;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\Extensions\ProgressBar;

class ProgressBarTest extends \PHPUnit_Framework_TestCase
{
  private $extension;
  
  protected function setUp()
  {
    $this->extension = new ProgressBar('');
  }
  
  public function testHandleResult()
  {
    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Response(new \Zend_Http_Response(200, array()));
    
    ob_start();
    $result = new Result($test, Result::STATUS_SUCCESS, '', '');
    $this->extension->handleResult($result, $response);
    
    $result = new Result($test, Result::STATUS_FAILED, '', '');
    $this->extension->handleResult($result, $response);
    
    $result = new Result($test, Result::STATUS_ERROR, '', '');
    $this->extension->handleResult($result, $response);
    
    $output = ob_get_contents();
    ob_clean();
    
    $this->assertEquals('  Running: *fe', $output);
  }
  
  public function testHandleConnectionStatusSuccess()
  {
    ob_start();
    $this->extension->handleConnectionStatus(new ConnectionStatus(ConnectionStatus::SUCCESS, new Uri('http://www.example.com')));
    $output = ob_get_contents();
    ob_clean();
    $this->assertEquals('', $output);
  }
  
  public function testHandleConnectionStatusError()
  {
    ob_start();
    $this->extension->handleConnectionStatus(new ConnectionStatus(ConnectionStatus::ERROR, new Uri('http://www.example.com')));
    $output = ob_get_contents();
    ob_clean();
    $this->assertEquals('  Running: E', $output);
  }
}