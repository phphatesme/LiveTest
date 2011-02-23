<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use Base\Www\Uri;

class TestSet
{
  private $uri;

  private $tests = array();

  public function __construct(Uri $uri)
  {
    $this->uri = $uri;
  }

  public function getUri()
  {
    return $this->uri;
  }

  public function addTest($test)
  {
    $this->tests[] = $test;
  }

  public function getTestCount( )
  {
    return count($this->tests);
  }

  public function getTests()
  {
    return $this->tests;
  }
}