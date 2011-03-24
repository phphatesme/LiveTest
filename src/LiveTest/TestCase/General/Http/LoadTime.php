<?php

/*
* This file is part of the LiveTest package.
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace LiveTest\TestCase\General\Http;

use LiveTest\TestCase\Exception;
use LiveTest\TestCase\TestCase;

use Base\Www\Uri;
use Base\Http\Response\Response;

class LoadTime implements TestCase
{
  private $maxLoadTime;

  public function init($maxLoadTime)
  {
    $this->maxLoadTime = $maxLoadTime;
  }

  public function test(Response $response, Uri $uri)
  {
    $loadTime = $response->getDuration();
    if ($loadTime > $this->maxLoadTime)
    {
      throw new Exception('The time to load the website is too big (current: ' . $loadTime . ', max: ' . $this->maxLoadTime . ')');
    }
  }
}