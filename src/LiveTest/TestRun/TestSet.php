<?php

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