<?php

namespace Unit\LiveTest\Packages\Reporting\Format;

use Unit\Base\Http\Response\MockUp;

use LiveTest\Connection\Request\Symfony as Request;

use Base\Http\ConnectionStatus;

use LiveTest\TestRun\Information;

use Base\Www\Uri;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\Report\Format\SimpleList;


abstract class FormatTest extends \PHPUnit_Framework_TestCase
{
  abstract protected function getFormat();

  private function getConnectionStatuses( )
  {
    $statuses = array();
    $statuses[] = new ConnectionStatus(ConnectionStatus::SUCCESS, Request::create(new Uri('http://www.connection-success.com')));
    $statuses[] = new ConnectionStatus(ConnectionStatus::ERROR, Request::create(new Uri('http://www.connection-error.com')), 'error message');

    return $statuses;
  }

  protected function getStandardFormattedContent()
  {
    $format = $this->getFormat();

    $set = new ResultSet();

    $defaultUri = new Uri('http://www.example.com');
    $request = Request::create($defaultUri);
    $test = new Test('TestName', 'TestClass', array('foo' => 'bar'));

    $successResult = new Result($test, Result::STATUS_SUCCESS, 'Success Message', $request, new MockUp(), 'mySession');
    $failureResult = new Result($test, Result::STATUS_FAILED, 'Failed Message', $request, new MockUp(), 'mySession');
    $errorResult = new Result($test, Result::STATUS_ERROR, 'Error Message', $request, new MockUp(), 'mySession');

    $set->addResult($successResult);
    $set->addResult($failureResult);
    $set->addResult($errorResult);

    $information = new Information(1, $defaultUri);
    return $format->formatSet($set, $this->getConnectionStatuses(), $information);
  }
}