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
    $this->assertInstanceOf('ClassMockup', $this->test->getClassName());
  }
  
  public function testGetName()
  {
    $this->assertEquals(true, is_string($this->test->getName()));
    $this->assertEquals('testName', $this->test->getName());
  }
  
  public function testGetParameter()
  {
    $this->assertEquals(true, is_string($this->test->getName()));
    $this->assertEquals('testName', $this->test->getName());
  }
  
   /**
     * @expectedException Base\Cli\WrongTypeException
     */
  public function testConstructorParameterClassException()
  {
    new Test('testName', 'ClassMockup', array('properties'));
  }
  
 /**
     * @expectedException Base\Cli\WrongTypeException
     */
  public function testConstructorParameterNameException()
  {
    new Test(1, new ClassMockup(), array('properties'));
  }
  
  /**
     * @expectedException PHPUnit_Framework_Error
     */
  public function testConstructorParameterPropertiesException()
  {
    new Test('testName', new ClassMockup(), 'properties');
  }
}