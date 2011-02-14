<?php

namespace Base\Www;

class Uri
{
  private $uri;
  
  public function __construct($uriString)
  {
    if (!self::isValid($uriString))
    {
      throw new \Base\Www\Exception('The given string (' . $uriString . ') does not represent a valid uri');
    }
    $this->uri = $uriString;
  }
  
  public function __toString()
  {
    return $this->toString();
  }
  
  public function toString()
  {
    return $this->uri;
  }
  
  public function concatUri($uriString)
  {
    if (strpos($uriString, 'http://') === false)
    {
      if (strpos($uriString, '/') === 0)
      {
        $url = $this->uri . $uriString;
      }
      else
      {
        $url = $this->uri . '/' . $uriString;
      }
    }
    else
    {
      $url = $uriString;
    }
    
    return new self($url);
  }
  
  /**
   * This static function returns true if a given string represents a valid uri, otherwise false.
   * 
   * @param string $uriString
   */
  public static function isValid($uriString)
  {
    $http = '((http(s)?|ftp):\/\/)?';
    $www = '(www\.)?';
    $domain = '([a-zA-Z]((\.|\-)?[a-zA-Z0-9])*)';
    $tld = '([a-zA-Z]{2,8})';
    $usw = '(\/|\/([a-zA-Z0-9|_|-|+|\.|,|\/|\:|;|\?|=|%|&|-])*)*';
    
    $regEx = '@^' . $http . $www . $domain . '\.' . $tld . $usw . '$@';
    
    return (bool)preg_match($regEx, $uriString);
  }
}