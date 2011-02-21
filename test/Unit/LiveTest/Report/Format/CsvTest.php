<?php

namespace Unit\LiveTest\Report\Format;

use LiveTest\TestRun\Information;

use Base\Www\Uri;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\Report\Format\SimpleList;

class SimpleListTest extends \PHPUnit_Framework_TestCase
{
  public function testFormat()
  {
    $format = new SimpleList();

    $set = new ResultSet();

    $uri    = new Uri('http://www.example.com');
    $test   = new Test('TestName', 'TestClass', new \Zend_Config(array('foo' => 'bar')));

    $successResult = new Result($test, Result::STATUS_SUCCESS, 'Success Message', $uri);
    $failureResult = new Result($test, Result::STATUS_FAILED, 'Failed Message', $uri);

    $set->addResult($successResult);
    $set->addResult($failureResult);

    $information = new Information(1, $uri);
    $formattedText = $format->formatSet($set, array(), $information);

    $expected = "     Url        :  http://www.example.com\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Success\n\n".
                "     Url        :  http://www.example.com\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Failed\n     Message    :  Failed Message\n\n";

    $this->assertEquals($expected, $formattedText);
  }
}