<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Http\Response;

use Base\Config\Yaml;

use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Test;
use LiveTest\Extensions\HtmlDocumentLog;

class HtmlDocumentLogTest extends \PHPUnit_Framework_TestCase
{
  private $logPath = 'logs/';
  private $testSuiteConfig = 'fixtures/HtmDocumentLogTestSuiteConfig.yml';
  
  private $createdFile = 'http%3A%2F%2Fwww.phphatesme.com';
  
  private $extension;
  
  public function setUp()
  {
    $config = new \Zend_Config(array('log_path' => $this->logPath));
    $this->extension = new HtmlDocumentLog('', $config);
  }
  
  public function tearDown()
  {
    unlink($this->logPath . '/' . $this->createdFile);
  }
  
  public function testHandleResult()
  {
    $test = new Test('', '', new \Zend_Config(array()));    
    $response = new Response(new \Zend_Http_Response(200, array(), '<body></body>'));
    
    $result = new Result($test, Result::STATUS_FAILED, '', 'http://www.phphatesme.com');
    $this->extension->handleResult($result, $response);
    
    $this->assertTrue(file_exists($this->logPath . '/' . $this->createdFile));
  }
}