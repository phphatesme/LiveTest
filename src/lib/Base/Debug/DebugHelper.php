<?php

namespace Base\Debug;

abstract class DebugHelper
{
  static public function doEcho($string)
  {
    echo $string;
  }
  
  static public function doVarDump($element)
  {
    echo "\nDEBUG: " . self::getPostion() . "\n";
    var_dump($element);
  }
  
  static public function setMarker()
  {
    echo "\nMARKER: " . self::getPostion() . "\n";
  }
  
  static private function getPostion($depth = 1)
  {
    $backtrace = debug_backtrace();
    return $backtrace[$depth]['file'] . '::' . $backtrace[$depth]['line'] . '  ';
  }
}