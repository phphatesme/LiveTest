<?php

namespace Unit\LiveTest\Report\Format;

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
    $statuses[] = new ConnectionStatus(ConnectionStatus::SUCCESS, new Uri('http://www.connection-success.com'));
    $statuses[] = new ConnectionStatus(ConnectionStatus::ERROR, new Uri('http://www.connection-error.com'), 'error message');

    return $statuses;
  }

  protected function getStandardFormattedContent()
  {
    $format = $this->getFormat();

    $set = new ResultSet();

    $uri = new Uri('http://www.example.com');
    $test = new Test('TestName', 'TestClass', array('foo' => 'bar'));

    $successResult = new Result($test, Result::STATUS_SUCCESS, 'Success Message', $uri);
    $failureResult = new Result($test, Result::STATUS_FAILED, 'Failed Message', $uri);
    $errorResult = new Result($test, Result::STATUS_ERROR, 'Error Message', $uri);

    $set->addResult($successResult);
    $set->addResult($failureResult);
    $set->addResult($errorResult);

    $information = new Information(1, $uri);
    return $format->formatSet($set, $this->getConnectionStatuses(), $information);
  }
}