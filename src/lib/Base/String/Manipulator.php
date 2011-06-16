<?php

namespace Base\String;

abstract class Manipulator
{
  public static function addCharsOnWhitespace($string, $chars, $length)
  {
    $oldString = $string;
    $newString = '';
    while (strlen($oldString) > $length)
    {
      $whitespaceFound = false;
      for($i = $length; $i > 0; $i--)
      {
        if ($oldString[$i] == ' ')
        {
          $newString .= substr($oldString, 0, $i) . $chars;
          $oldString = substr($oldString, $i);
          $whitespaceFound = true;
          break;
        }
      }
      if (!$whitespaceFound)
      {
        $length++;
      }
    }
    return $newString . $oldString;
  }
}