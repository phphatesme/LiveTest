<?php

namespace LiveTest\TestCase;

use Base\Www\Uri;

use Base\Http\Response;
use Base\Http\Client;

// @todo die Parameter können bis jetzt nur eine Liste sein, keine Struktur möglich.

interface TestCase
{
  public function __construct( $parameter );
  public function test(\Zend_Http_Response $httpResponse, Uri $uri);
}