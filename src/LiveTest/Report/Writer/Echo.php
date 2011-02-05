<?php

namespace LiveTest\Report\Writer;

class Echo implements Writer
{
  public function write($formatedText)
  {
    echo "\n\n";
    echo $formatedText;
  }
}
