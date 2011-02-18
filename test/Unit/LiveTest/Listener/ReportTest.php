<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Http\Response\Zend;

use LiveTest\TestRun\Information;

use Annovent\Event\Dispatcher;

use Base\Http\Response\Response;

use LiveTest\Listener\Report;

use Base\Www\Uri;
use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class ReportTest extends \PHPUnit_Framework_TestCase
{
  private $listener;

  private function initReportListener()
  {
    $this->listener = new Report('', new Dispatcher());

    $writerConfig = array('class' => 'LiveTest\Report\Writer\SimpleEcho');
    $formatConfig = array('class' => 'LiveTest\Report\Format\Csv');

    $this->listener->init($formatConfig, $writerConfig);
  }

  public function testHandleResult()
  {
    $this->initReportListener();

    $test = new Test('TestName', 'ClassName', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array()));

    $result = new Result($test, Result::STATUS_SUCCESS, 'Success', 'http://www.example.com');
    $this->listener->handleResult($result, $response);

    ob_start();
    $this->listener->postRun(new Information('5000', new Uri('http://www.example.com')));
    $actual = ob_get_contents();
    ob_clean();

    $expected = "\n\nhttp://www.example.com;TestName;ClassName;success\n";

    $this->assertEquals($expected, $actual);
  }

  public function testHandleResultLogStatuses()
  {
    $this->listener = new Report('', new Dispatcher());

    $writerConfig = array('class' => 'LiveTest\Report\Writer\SimpleEcho');
    $formatConfig = array('class' => 'LiveTest\Report\Format\Csv');

    $this->listener->init($formatConfig, $writerConfig, array(Result::STATUS_FAILED));

    $test = new Test('TestName', 'ClassName', new \Zend_Config(array()));
    $response = new Zend(new \Zend_Http_Response(200, array()));

    $result = new Result($test, Result::STATUS_SUCCESS, 'Success', 'http://www.example.com');
    $this->listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_FAILED, 'Failed', 'http://www.example.com');
    $this->listener->handleResult($result, $response);

    ob_start();
    $this->listener->postRun(new Information('5000', new Uri('http://www.example.com')));
    $actual = ob_get_contents();
    ob_clean();

    $expected = "\n\nhttp://www.example.com;TestName;ClassName;failure\n";

    $this->assertEquals($expected, $actual);
  }
}