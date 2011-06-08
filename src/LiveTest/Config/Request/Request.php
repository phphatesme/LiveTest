<?php

namespace LiveTest\Config\Request;

use Base\Www\Uri;
use Base\Http\Request\Request as BaseRequest;

interface Request extends BaseRequest
{  
  public function getIdentifier();
}