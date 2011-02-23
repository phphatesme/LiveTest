<?php
namespace Unit\LiveTest\TestRun;

use LiveTest\TestRun\Result\ResultSet;

use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Test;
use Base\Www\Uri;

class ResultSetTest extends \PHPUnit_Framework_TestCase
{
  protected function createResult($status)
  {
    $test = new Test('name', 'className', new \Zend_Config(array()));
    $status = $status;
    $message = 'foo';
    $uri = new Uri('http://www.example.com');
    
    return new Result($test, $status, $message, $uri);
  }

  public function testGetStatus()
  {
    $resultSet = new ResultSet();
    $this->assertEquals(Result::STATUS_SUCCESS, $resultSet->getStatus());

    $result = $this->createResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_SUCCESS, $resultSet->getStatus());

    $result = $this->createResult(Result::STATUS_FAILED);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_FAILED, $resultSet->getStatus());

    $result = $this->createResult(Result::STATUS_ERROR);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_ERROR, $resultSet->getStatus());

    $result = $this->createResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result);
    $this->assertEquals(Result::STATUS_ERROR, $resultSet->getStatus());
  }

  public function testGetResultCount()
  {
    $resultSet = new ResultSet();
    $this->assertEquals(0, $resultSet->getResultCount());

    $result1 = $this->createResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result1);
    $this->assertEquals(1, $resultSet->getResultCount());

    $result2 = $this->createResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result2);
    $this->assertEquals(2, $resultSet->getResultCount());
  }

  public function testGetResults()
  {
    $resultSet = new ResultSet();
    $this->assertEquals(array(), $resultSet->getResults());

    $result1 = $this->createResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result1);
    $this->assertEquals(array($result1), $resultSet->getResults());

    $result2 = $this->createResult(Result::STATUS_SUCCESS);
    $resultSet->addResult($result2);
    $this->assertEquals(array($result1, $result2), $resultSet->getResults());
  }

  
}
