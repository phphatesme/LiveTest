<?php

namespace Unit\LiveTest\Packages\Reporting\Writer;

use LiveTest\Packages\Reporting\Writer\SimpleEcho;

class SimpleEchoTest extends \PHPUnit_Framework_TestCase
{
  public function testWrite( )
  {
    $writer = new SimpleEcho();

    $expected = 'Hallo';

    ob_start();
    $writer->write('Hallo');
    $actual = ob_get_contents();
    ob_clean();

    $this->assertEquals("\n\n".$expected, $actual);
  }
}
