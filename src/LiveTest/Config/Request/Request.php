<?php

namespace LiveTest\Config\Request;
use Base\Www\Uri;

use Base\Http\Request\Request as BaseRequest;

interface Request extends BaseRequest
{
  public static function create(Uri $uri, $method = 'get', $requestParameters = array());
  public function getIdentifier();
}