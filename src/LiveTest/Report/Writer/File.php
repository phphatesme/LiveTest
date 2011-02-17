<?php

namespace LiveTest\Report\Writer;

use LiveTest\Exception;

class File implements Writer
{
  private $filename;
    
  public function init($filename)
  {
    $this->filename = $filename;
  }
  
  public function write($formatedText)
  {          
    file_put_contents($this->filename, $formatedText);
  }
}