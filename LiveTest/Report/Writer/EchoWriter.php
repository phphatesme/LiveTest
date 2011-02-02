<?php

namespace LiveTest\Report\Writer;

class EchoWriter implements Writer
{
  public function write($formatedText)
  {
    echo "\n\n";
    echo $formatedText;
  }
}