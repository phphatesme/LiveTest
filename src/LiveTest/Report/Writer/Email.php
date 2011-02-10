<?php

namespace LiveTest\Report\Writer;

use LiveTest\Exception;

class Email implements Writer
{
  private $filename;
  
  public function __construct(\Zend_Config $config)
  {
  }
  
  public function write($formatedText)
  {          
  }
}
