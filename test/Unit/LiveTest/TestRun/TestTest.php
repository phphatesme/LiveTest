<?php
namespace Unit\LiveTest\TestRun;

use LiveTest\TestRun\Test;
use Base\Config\Yaml;


class TestTest extends \PHPUnit_Framework_TestCase
{
  private $test;

  public function setUp()
  {
    $this->test = new Test('testName', 'ClassMockup', new Yaml(__DIR__.'/Fixtures/testsuite.yml', true));
  }

  public function testGetClassName()
  {
    $this->assertEquals(true, is_string($this->test->getClassName()));
    $this->assertEquals('ClassMockup', $this->test->getClassName());
  }

  public function testGetName()
  {
    $this->assertEquals(true, is_string($this->test->getName()));
    $this->assertEquals('testName', $this->test->getName());
  }

  public function testGetParameter()
  {
    $this->assertObjectHasAttribute('filename', $this->test->getParameter());
    $this->assertObjectHasAttribute('_data', $this->test->getParameter());
  }

   /**
     * @expectedException Base\Cli\WrongTypeException
     */
  public function testConstructorParameterClassNameException()
  {
    new Test('testName', 1, new Yaml(__DIR__.'/Fixtures/testsuite.yml', true));
  }

 /**
     * @expectedException Base\Cli\WrongTypeException
     */
  public function testConstructorParameterNameException()
  {
    new Test(1, 'ClassMockup', new Yaml(__DIR__.'/Fixtures/testsuite.yml', true));
  }

  /**
     * @expectedException PHPUnit_Framework_Error
     */
  public function testConstructorParameterPropertiesException()
  {
    new Test('testName', 'ClassMockup', 'properties');
  }
}