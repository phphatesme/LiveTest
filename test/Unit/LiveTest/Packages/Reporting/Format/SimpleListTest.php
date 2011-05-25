<?php

namespace Unit\LiveTest\Packages\Reporting\Format;

use LiveTest\TestRun\Information;

use Base\Www\Uri;

use LiveTest\TestRun\Test;
use LiveTest\TestRun\Result\Result;
use LiveTest\TestRun\Result\ResultSet;
use LiveTest\Packages\Reporting\Format\SimpleList;

class SimpleListTest extends FormatTest
{
  protected function getFormat()
  {
    return new SimpleList();
  }

  public function testFormat()
  {
    $formattedText = $this->getStandardFormattedContent();

    $expected = "     Connection Statuses:\n\n".
                "       Url     : http://www.connection-error.com/\n".
                "       Message : error message\n\n".
                "     Result Statuses:\n\n".
                "     Url        :  http://www.example.com/\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Success\n\n".
                "     Url        :  http://www.example.com/\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Failed\n     Message    :  Failed Message\n\n".
                "     Url        :  http://www.example.com/\n     Test       :  TestName\n     Test Class :  TestClass\n     Status     :  Error\n     Message    :  Error Message\n\n";

    $this->assertEquals($expected, $formattedText);
  }
}