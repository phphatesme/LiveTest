<?php

namespace Unit\LiveTest\Report\Writer;

use LiveTest\Report\Writer\File;

class FileTest extends \PHPUnit_Framework_TestCase
{
  public function testWrite( )
  {
    $filename = tempnam("/tmp", "writer");

    $writer = new File();
    $writer->init($filename);

    $string = 'Hallo';
    $writer->write($string);

    $contents = file_get_contents($filename);
    $this->assertEquals($string, $contents);

    unlink($filename);
  }
}
