<?php

namespace Test\Unit\LiveTest\Listener;

<<<<<<< HEAD
use Base\Www\Uri;

=======
>>>>>>> 0dedd828b6fbccfed8a07eb12de3ccf8e5bfce07
use Base\Http\Response\Zend;

use Annovent\Event\Dispatcher;

use Base\Http\Response\Response;

use Base\Config\Yaml;

use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Test;
use LiveTest\Listener\HtmlDocumentLog;

class HtmlDocumentLogTest extends \PHPUnit_Framework_TestCase
{
<<<<<<< HEAD
  private $logPath = 'logs';

  private $createdFile = 'http%3A%2F%2Fwww.example.com';

  private $fullLogPath;
=======
  private $logPath = 'logs/';

  private $createdFile = 'http%3A%2F%2Fwww.phphatesme.com';
>>>>>>> 0dedd828b6fbccfed8a07eb12de3ccf8e5bfce07

  private $listener;

  public function setUp()
  {
<<<<<<< HEAD
    $this->listener = new HtmlDocumentLog('1', new Dispatcher());
    $this->fullLogPathInit = __DIR__ . DIRECTORY_SEPARATOR . $this->logPath;
    $this->fullLogPath     = $this->fullLogPathInit.'/1/';
=======
    $this->listener = new HtmlDocumentLog('', new Dispatcher());
>>>>>>> 0dedd828b6fbccfed8a07eb12de3ccf8e5bfce07
  }

  public function tearDown()
  {
<<<<<<< HEAD
    @unlink($this->fullLogPath . $this->createdFile);
=======
    @unlink($this->logPath . '/' . $this->createdFile);
>>>>>>> 0dedd828b6fbccfed8a07eb12de3ccf8e5bfce07
  }

  public function testHandleResultNoLogStatuses()
  {
<<<<<<< HEAD
    $this->listener->init( $this->fullLogPathInit);

    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array(), '<body></body>'));

    $result = new Result($test, Result::STATUS_FAILED, '', new Uri('http://www.example.com'));

    $this->listener->handleResult($result, $response);

    $this->assertTrue(file_exists($this->fullLogPath . $this->createdFile));
=======
    $this->listener->init(__DIR__ . DIRECTORY_SEPARATOR . $this->logPath);

    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array(), '<body></body>'));
    $result = new Result($test, Result::STATUS_FAILED, '', 'http://www.phphatesme.com');

    $this->listener->handleResult($result, $response);

    $this->assertTrue(file_exists($this->logPath . '/' . $this->createdFile));
>>>>>>> 0dedd828b6fbccfed8a07eb12de3ccf8e5bfce07
  }

  public function testHandleResultLogStatuses()
  {
    $this->listener->init(__DIR__ . DIRECTORY_SEPARATOR . $this->logPath, array( Result::STATUS_SUCCESS) );

    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array(), '<body></body>'));
<<<<<<< HEAD
    $result = new Result($test, Result::STATUS_FAILED, '', new Uri( 'http://www.example.com'));
=======
    $result = new Result($test, Result::STATUS_FAILED, '', 'http://www.phphatesme.com');
>>>>>>> 0dedd828b6fbccfed8a07eb12de3ccf8e5bfce07

    $this->listener->handleResult($result, $response);

    $this->assertFalse(file_exists($this->logPath . '/' . $this->createdFile));
  }
}