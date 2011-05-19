<?php

namespace Base\ArrayLists;

class Recursive
{
  
  /**
   *
   * Lend from: http://de.php.net/manual/de/function.implode.php#96100
   * Thanks kromped!
   * @param unknown_type $glue
   * @param unknown_type $pieces
   */
  public static function implode( $glue, $pieces )
  {
    $retVal = array();

    foreach( $pieces as $rPieces )
    {
      if( is_array( $rPieces ) )
      {
        ksort($rPieces);
        $retVal[] = self::implode( $glue, $rPieces );
      }
      else
      {
        $retVal[] = $rPieces;
      }
    }
    return implode( $glue, $retVal );
  }
  
}