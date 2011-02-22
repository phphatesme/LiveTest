<?php

namespace Unit\LiveTest\Report\Format;

use LiveTest\TestRun\Information;

use Base\Www\Uri;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\Report\Format\SimpleList;

class SimpleListTest extends FormatTest
{
  protected function getFormat()
  {
    return new SimpleList();
  }

  public function testFormat()
  {
    $formattedText = $this->getStandardFormattedContent();

    $expected = "     Url        :  http://www.example.com\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Success\n\n".
                "     Url        :  http://www.example.com\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Failed\n     Message    :  Failed Message\n\n".
                "     Url        :  http://www.example.com\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Error\n     Message    :  Error Message\n\n";

    $this->assertEquals($expected, $formattedText);
  }
}
