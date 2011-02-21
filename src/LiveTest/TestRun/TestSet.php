<?php

namespace LiveTest\TestRun;

class TestSet
{
  public $url;
  
  private $tests = array();
  
  public function __construct($url)
  {
    $this->url = $url;
  }
  
  public function getUrl()
  {
    return $this->url;
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