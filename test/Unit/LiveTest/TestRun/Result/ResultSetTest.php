<?php
namespace Unit\LiveTest\TestRun;

use LiveTest\Config\Request\Symfony;

use LiveTest\TestRun\Result\ResultSet;

use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Test;
use Base\Www\Uri;

class ResultSetTest extends \PHPUnit_Framework_TestCase
{
  protected function createNewResult($status)
  {
    $test = new Test('name', 'className');
    return new Result($test, $status, 'foo', Symfony::create(new Uri('http://www.example.com/')));
  }

  public function testGetStatus()
  {
    $resultSet = new ResultSet();
    $this->assertEquals(Result::STATUS_SUCCESS, $resultSet->getStatus());

    $result = $this->createNewResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_SUCCESS, $resultSet->getStatus());

    $result = $this->createNewResult(Result::STATUS_FAILED);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_FAILED, $resultSet->getStatus());

    $result = $this->createNewResult(Result::STATUS_ERROR);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_ERROR, $resultSet->getStatus());

    $result = $this->createNewResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_ERROR, $resultSet->getStatus());
  }

  public function testGetResultCount()
  {
    $resultSet = new ResultSet();
    $this->assertEquals(0, count( $resultSet));

    $result1 = $this->createNewResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result1);
    $this->assertEquals(1,count($resultSet));

    $result2 = $this->createNewResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result2);
    $this->assertEquals(2, count($resultSet));
  }
}
