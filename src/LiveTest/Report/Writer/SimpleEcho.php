<?php

namespace LiveTest\Report\Writer;

class SimpleEcho implements Writer
{
  public function write($formatedText)
  {
    echo "\n\n";
    echo $formatedText;
  }
}
