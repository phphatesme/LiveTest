<?php

namespace Test\Unit\LiveTest\Extensions;

use Base\Www\Uri;

use Annovent\Event\Dispatcher;

use Base\Http\Response;

use LiveTest\Listener\StatusBar;
use LiveTest\TestRun\Information;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class StatusBarTest extends \PHPUnit_Framework_TestCase
{
  public function testOutput()
  {
    $listener = new StatusBar('', new Dispatcher());

    $test = new Test('', '', new \Zend_Config(array()));
    $response = new Response(new \Zend_Http_Response(200, array()));

    $result = new Result($test, Result::STATUS_SUCCESS, '', '');
    $listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_FAILED, '', '');
    $listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_ERROR, '', '');
    $listener->handleResult($result, $response);

    ob_start();
    $listener->postRun(new Information('5000', new Uri('http://www.example.com')));
    $actual = ob_get_contents();
    ob_clean();

    $expected = "  Tests: 3 (failed: 1, error: 1) - Duration: 1 hour(s) 23 minute(s) 20 second(s)";

    $this->assertEquals($expected, $actual);
  }
}