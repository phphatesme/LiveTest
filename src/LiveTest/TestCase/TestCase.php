<?php

namespace LiveTest\TestCase;

use Base\Www\Uri;

use Base\Http\Response;
use Base\Http\Client;

// @todo die Parameter können bis jetzt nur eine Liste sein, keine Struktur möglich.

interface TestCase
{
  /**
   * @param Base\Config\Config $parameter The parameters defined in the external configuration
   */
  public function __construct( $parameter );
  
  /**
   * This function runs the test case
   * 
   * @param Base\Http\Response $httpResponse
   * @param Base\Www\Uri $uri
   */
  public function test(Response $httpResponse, Uri $uri);
}