<?php

namespace LiveTest\TestCase;

use Base\Www\Uri;

use Base\Www\Html\Document;
use Base\Http\Response;

abstract class HtmlTestCase extends ConfigurableTestCase
{
  private $parameter;
  
  protected $mandatoryParameter = array();
  
  private $httpResponse;
  private $uri;
  
  public function getUri()
  {
    return $this->uri;
  }
  
  public function test(\Zend_Http_Response $httpResponse, Uri $uri)
  {
    $this->httpResponse = $httpResponse;
    $this->uri = $uri;
    
    $htmlDocument = new Document($httpResponse->getBody());
    $this->runTest($htmlDocument);
  }
  
  protected function getHttpResponse()
  {
    return $this->httpResponse;
  }
  
  abstract protected function runTest(Document $htmlDocument);
}