<?php
namespace Unit\LiveTest\Connection\Request;

/**
 * test case.
 */
use Base\Www\Uri;
use LiveTest\Connection\Request\Symfony as Request;

class SymfonyTest extends \PHPUnit_Framework_TestCase
{
  private $exampleUri;
  
  /**
   * Prepares the environment before running a test.
   */
  protected function setUp()
  {
    $this->exampleUri = "http://www.example.com";
  }
  
  /**
   * Cleans up the environment after running a test.
   */
  protected function tearDown()
  {
  
  }
  
  /**
   * @expectedException Exception
   */
  public function testCreateRequestsFromParametersEmptyArrayException()
  {
    Request::createRequestsFromParameters(array (), new Uri($this->exampleUri));
  }
  
  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testCreateRequestsFromParametersNoParametersException()
  {
    Request::createRequestsFromParameters("test", new Uri($this->exampleUri));
  }
  
  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testCreateRequestsFromParametersNoUriException()
  {
    Request::createRequestsFromParameters(array ("test" => 1), "test");
  }
  
  /**
   * @expectedException PHPUnit_Framework_Error
   */
  public function testCreateNoUriException()
  {
    Request::create(null);
  }
  
  public function testCreate()
  {
    $request = Request::create(new Uri($this->exampleUri), 'post', array ("user" => "test"));
    
    $this->assertEquals("POST", $request->getMethod());
    
    $params = $request->getParameters();
    $this->assertEquals("test", $params['user']);
    $this->assertEquals($this->exampleUri . '/', $request->getUri());
    
    $this->assertEquals('http://www.example.com/_POST_user_test', $request->getIdentifier());
  }
}

