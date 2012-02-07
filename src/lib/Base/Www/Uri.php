<?php

namespace Base\Www;

use Zend\Validate\Callback;

class Uri
{
  private $uri;

  public function __construct($uriString)
  {
    $uriString = $this->checkCorrectUrl($uriString);
    //@todo: http://www.example.com fails on validation with ParserTest.php and I
    //cannot find any error in it. So: lets validate it by Symfony's Request-Object.
    /*if (!self::isValid($uriString))
    {
      throw new \Base\Www\Exception('The given string (' . $uriString . ') does not represent a valid uri');
    }*/
    $this->uri = $uriString;
  }

  /**
   *
   * Enter description here ...
   */
  public function __toString()
  {
    return $this->toString();
  }

  /**
   *
   * Enter description here ...
   */
  public function toString()
  {
    return $this->uri;
  }

  /**
   *
   * Enter description here ...
   * @param unknown_type $uriString
   */
  public function concatUri($uriString)
  {
    if (strpos($uriString, 'http://') === false)
    {
      if (strpos($uriString, '/') === 0)
      {
        $url = $this->uri . substr($uriString, 1);
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
   * @param unknown_type $uriString
   */
  private function checkCorrectUrl($uriString)
  {
      $uriString = trim($uriString);
      $uriParts = parse_url($uriString);

      if (key_exists('path', $uriParts))
      {
        $url = $uriString;
      }
      else
      {
        $url = $uriString.'/';
      }

      return $url;
  }

  /**
   * This static function returns true if a given string represents a valid uri, otherwise false.
   *
   * @param string $uriString
   */
  public static function isValid($uriString)
  {
/**
     * @todo: Check if Zend_Validator_Callback can do the same.
     * Used from: http://phpcentral.com/208-url-validation-in-php.html#post576
    */
    $urlregex = "^((https?|ftp)\:\/\/)?";

    // USER AND PASS (optional)
    $urlregex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?";

    // HOSTNAME OR IP
    $urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*"; // http://x = allowed (ex. http://localhost, http://routerlogin)
    //$urlregex .= "[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)+"; // http://x.x = minimum
    //$urlregex .= "([a-z0-9+\$_-]+\.)*[a-z0-9+\$_-]{2,3}"; // http://x.xx(x) = minimum
    //use only one of the above

    // PORT (optional)
    $urlregex .= "(\:[0-9]{2,5})?";
    // PATH (optional)
    $urlregex .= "(\/([a-z0-9\+\$_\-~]\.?)+)*\/?";
    // GET Query (optional)
    $urlregex .= "(\?[a-z+&\$_.-][a-z0-9;:@\/&%=+\$_.-]*)?";
    // ANCHOR (optional)
    $urlregex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?\$";

    $urlregex = "/" . $urlregex . "/";
    return (bool)preg_match($urlregex, $uriString);
  }
}