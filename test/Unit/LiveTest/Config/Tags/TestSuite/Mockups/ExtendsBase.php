<?php
namespace Unit\LiveTest\Config\Tags\TestSuite\Mockups;

use LiveTest\Config\Tags\TestSuite\Base;

class ExtendsBase extends Base
{
  private $config;
  
  private $parameters;
  
  protected function doProcess(\LiveTest\Config\TestSuite $config, $parameters)
  {
    $this->parameters = "OK";
    $this->config = "OK";
    
  }
  
  public function getParameters()
  {
    return $this->parameters;
  }
  
  public function getConfig()
  {
    return $this->config;
  }
}