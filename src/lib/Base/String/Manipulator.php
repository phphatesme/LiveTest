<?php

namespace Base\String;

abstract class Manipulator
{
  public static function addCharsOnWhitespace($string, $chars, $length)
  {
    $oldString = $string;
    $newString = '';
    while ( strlen($oldString) > $length )
    {
      for($i = $length; $i >= 0; $i--)
      {
        if ($oldString[$i] == ' ' || $i == 0)
        {
          $newString .= substr($oldString, 0, $i) . $chars;
          $oldString = substr($oldString, $i);
          break;
        }
      }
    }
    return $newString.$oldString;
  }
}