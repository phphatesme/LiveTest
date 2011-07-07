<?php

namespace Unit\LiveTest\Packages\Runner\Listeners;

use LiveTest\Connection\Request\Symfony as Request;

use Unit\Base\Http\Response\MockUp;

use Base\Www\Uri;

use LiveTest\Event\Dispatcher;

use LiveTest\Packages\Runner\Listeners\StatusBar;
use LiveTest\TestRun\Information;
use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;

class StatusBarTest extends \PHPUnit_Framework_TestCase
{
  public function testOutput()
  {
    $listener = new StatusBar('', new Dispatcher());

    $test = new Test('', '');

    $response = new MockUp();
    $response->setStatus(200);

    $result = new Result($test, Result::STATUS_SUCCESS, '', Request::create(new Uri('http://www.example.com')), 'mySession');
    $listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_FAILED, '', Request::create(new Uri('http://www.example.com')), 'mySession');
    $listener->handleResult($result, $response);

    $result = new Result($test, Result::STATUS_ERROR, '', Request::create(new Uri('http://www.example.com')), 'mySession');
    $listener->handleResult($result, $response);

    ob_start();
    $listener->postRun(new Information('5000', new Uri('http://www.example.com')));
    $actual = ob_get_contents();
    ob_clean();

    $expected = "  Tests: 3 (failed: 1, error: 1) - Duration: 1 hour(s) 23 minute(s) 20 second(s)";

    $this->assertEquals($expected, $actual);
  }
}