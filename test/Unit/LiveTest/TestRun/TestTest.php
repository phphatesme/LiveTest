<?php
namespace Unit\LiveTest\TestRun;

use LiveTest\TestRun\Test;
use Base\Config\Yaml;


class TestTest extends \PHPUnit_Framework_TestCase
{
  private $test;

  public function setUp()
  {
    $this->test = new Test('testName', 'ClassMockup', $this->getTestSuiteConfig());
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
    $this->assertArrayHasKey('TestSuite', $this->test->getParameter());
  }

  private function getTestSuiteConfig( )
  {
    $yaml = new Yaml(__DIR__.'/Fixtures/testsuite.yml', true);
    return $yaml->toArray();
  }

   /**
     * @expectedException Base\Cli\WrongTypeException
     */
  public function testConstructorParameterClassNameException()
  {
    new Test('testName', 1, $this->getTestSuiteConfig());
  }

 /**
     * @expectedException Base\Cli\WrongTypeException
     */
  public function testConstructorParameterNameException()
  {
    new Test(1, 'ClassMockup', $this->getTestSuiteConfig());
  }

  /**
     * @expectedException PHPUnit_Framework_Error
     */
  public function testConstructorParameterPropertiesException()
  {
    new Test('testName', 'ClassMockup', 'properties');
  }
}