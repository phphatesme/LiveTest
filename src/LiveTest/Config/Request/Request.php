<?php

namespace LiveTest\Config\Request;
use Base\Www\Uri;

use Base\Http\Request\Request as BaseRequest;

interface Request extends BaseRequest
{
  public static function create(Uri $uri, $method = 'get', array $requestParameters);
  public function getIdentifier();
}