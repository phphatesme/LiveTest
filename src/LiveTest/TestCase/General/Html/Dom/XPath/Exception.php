<?php

namespace LiveTest\TestCase\General\Html\Dom\XPath;

class Exception extends \LiveTest\TestCase\Exception
{
	private $xpath;
	
  public function __construct($message, $xpath, $code = null, $previous = null)
  {
  	$this->xpath = $xpath;
    parent::__construct($message, $code, $previous);
  }
  
  public function getXPath()
  {
    return $this->xpath;
  }
} 