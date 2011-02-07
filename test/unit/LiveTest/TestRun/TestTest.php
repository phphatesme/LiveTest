<?php
use LiveTest\TestRun\Test;

class ClassMockup
{
  public $testAttribute = true;
  function getTestAttribute()
  {
    return $this->testAttribute;
  }
}

class TestTest extends PHPUnit_Framework_TestCase
{
  private $test;

  public function setUp()
  {
    $this->test = new Test('testName', new ClassMockup(), array('properties'));
  }

  public function testGetClass()
  {
    $this->assertInstanceOf('ClassMockup', $this->test->getClass());
  }
  
  public function testGetName()
  {
    $this->assertEquals(true, is_string($this->test->getName()));
    $this->assertEquals('testName', $this->test->getName());
  }
  
  public function getParameter()
  {
    $this->assertEquals(true, is_string($this->test->getName()));
    $this->assertEquals('testName', $this->test->getName());
  }
}