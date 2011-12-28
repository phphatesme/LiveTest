<?php
namespace Unit\LiveTest\TestRun\Mockups;

use Base\Http\Request\Request;

use Base\Http\Response\Zend;

use Base\Http\Response\Response;
use Base\Http\Client\Client;

class HttpClientMockup implements Client
{

  private $response;
  private $uri;
  private $nextRequestFails = false;
  private $timeout;
  private $postParam = array();
  private $request;

  public function __construct(Response $response)
  {
    $this->response = $response;
  }

  public function nextRequestFails()
  {
    $this->nextRequestFails = true;
  }

  public function request(Request $request)
  {
  	$this->request = $request;
    if ($this->nextRequestFails)
    {
      $this->nextRequestFails = false;
      throw new \Zend\Http\Client\Exception\RuntimeException('TestException');
    }
    return $this->response;
  }

  public function getRequest( )
  {
  	return $this->request;
  }

  public function setUri($uri)
  {
    $this->uri = $uri;
  }

  public function setParameterPost($name, $value = null)
  {
    if(is_array($name))
    {
      $this->postParam = $name;
    }
    else
    {
      $this->postParam[$name] = $value;
    }
  }

  public function getTimeout()
  {
    return $this->timeout;
  }

  public function setTimeout( $timeout )
  {
    $this->timeout = $timeout;
  }

  public function setParameterGet($name, $value = null)
  {
    if(is_array($name))
    {
      $this->postParam = $name;
    }
    else
    {
      $this->postParam[$name] = $value;
    }
  }

  public function resetParameters( )
  {
  }
}