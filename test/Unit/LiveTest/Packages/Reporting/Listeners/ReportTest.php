<?php

namespace Test\Unit\LiveTest\Packages\Reporting\Listeners;

use LiveTest\Packages\Reporting\Listeners\Report;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

use Unit\Base\Http\Response\MockUp;

use LiveTest\TestRun\Information;
use LiveTest\Event\Dispatcher;

use Base\Www\Uri;
use Base\Http\ConnectionStatus;

use LiveTest\Config\Request\Symfony as Request;

class ReportTest extends \PHPUnit_Framework_TestCase
{
  private $listener;

  private function initReportListener()
  {
    $this->listener = new Report('', new Dispatcher());

    $writerConfig = array('class' => 'LiveTest\Packages\Reporting\Writer\SimpleEcho');
    $formatConfig = array('class' => 'LiveTest\Packages\Reporting\Format\Csv');

    $this->listener->init($formatConfig, $writerConfig);
  }

  public function testHandleResult()
  {
    $this->initReportListener();

    $test = new Test('TestName', 'ClassName');

    $response = new MockUp();

    $result = new Result($test, Result::STATUS_SUCCESS, 'Success', Request::create(new Uri('http://www.example.com')));
    $this->listener->handleResult($result, $response);

    ob_start();
    $this->listener->postRun(new Information('5000', new Uri('http://www.example.com')));
    $actual = ob_get_contents();
    ob_clean();

    $expected = "\n\nhttp://www.example.com/;TestName;ClassName;success\n";

    $this->assertEquals($expected, $actual);
  }

  public function testHandleResultLogStatuses()
  {
    $this->listener = new Report('', new Dispatcher());

    $writerConfig = array('class' => 'LiveTest\Packages\Reporting\Writer\SimpleEcho');
    $formatConfig = array('class' => 'LiveTest\Packages\Reporting\Format\Csv');

    $this->listener->init($formatConfig, $writerConfig, array(Result::STATUS_FAILED));

    $test = new Test('TestName', 'ClassName');

    $response = new MockUp();

    $result = new Result($test, Result::STATUS_SUCCESS, 'Success', Request::create(new Uri('http://www.example.com')));
    $this->listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_FAILED, 'Failed', Request::create(new Uri('http://www.example.com')));

    $this->listener->handleResult($result, $response);

    ob_start();
    $this->listener->postRun(new Information('5000', new Uri('http://www.example.com')));
    $actual = ob_get_contents();
    ob_clean();

    $expected = "\n\nhttp://www.example.com/;TestName;ClassName;failure\n";

    $this->assertEquals($expected, $actual);
  }

  public function testSendOnSuccessFalse()
  {
    $this->listener = new Report('', new Dispatcher());

    $writerConfig = array('class' => 'LiveTest\Packages\Reporting\Writer\SimpleEcho');
    $formatConfig = array('class' => 'LiveTest\Packages\Reporting\Format\Csv');

    $this->listener->init($formatConfig, $writerConfig, null, false);

    $test = new Test('TestName', 'ClassName');

    $response = new MockUp();

    $result = new Result($test, Result::STATUS_SUCCESS, 'Success', Request::create(new Uri('http://www.example.com')));
    $this->listener->handleResult($result, $response);
    ob_start();
    $this->listener->postRun(new Information('5000', new Uri('http://www.example.com')));
    $actual = ob_get_contents();
    ob_clean();

    $this->assertEquals("", $actual);
  }

  public function testConfigurableFormatAndWriter()
  {
    $this->listener = new Report('', new Dispatcher());

    $writerConfig = array('class' => 'LiveTest\Packages\Reporting\Writer\File','parameter' => array('filename' => 'test.log'));
    $formatConfig = array('class' => 'LiveTest\Packages\Reporting\Format\Html','parameter' => array('template' => 'test.tpl'));

    $this->listener->init($formatConfig, $writerConfig);
  }
}