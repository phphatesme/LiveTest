<?php

namespace LiveTest\Config\Request;

use LiveTest\Exception;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Base\Http\Request\Request as RequestInterface;

class LiveTest extends SymfonyRequest implements RequestInterface
{

  private static $identifier;

 /**
   *
   * Enter description here ...
   * @param array $parameters
   */
  public static function createRequestsFromParameters(array $parameters)
  {

    if(count($parameters) <= 0)
    {
      throw new Exception('Parameter has to be set.');
    }

    $requests = array();
    $preparedRequestParameters = self::prepareRequestParameters($parameters);

    foreach($preparedRequestParameters as $aPreparedParameter)
    {
      $requests[] = self::createPageRequestFromParameters($aPreparedParameter);
    }

    return $requests;
  }

  public static function createPageRequestFromParameters(array $parameters)
  {
     $request =  self::create(
                  $parameters['uri'],
                  $parameters['requestType'],
                  $parameters['requestParameter']);

    $request->setIdentifier($parameters);
    return $request;
  }

  private function setIdentifier(array $parameters)
  {
    $this->identifier = md5($this->recursiveImplode('_',$parameters));
  }

  private static function prepareRequestParameters(array $parameters)
  {
    $mergedRequestParameters = array();
    foreach($parameters as $aRequest)
    {
      if(is_array($aRequest))
      {
        foreach($aRequest as $uri => $requestParameters)
        {
          $mergedRequestParameters[] = self::getMergedRequestParameters($uri, $requestParameters);
        }
      }
      else
      {
        $uri = $aRequest;
        $mergedRequestParameters[] = self::getMergedRequestParameters($uri, array());
      }
    }
    return $mergedRequestParameters;
  }

  private static function getMergedRequestParameters($uri, array $parameters)
  {
     $defaults = array(
            'uri'          => '',
            'requestType' => 'get',
            'requestParameter' => array(),
        );

    $parameters['uri'] = $uri;
    return  array_merge($defaults, $parameters);
  }

  public function getIdentifier()
  {
    return $this->identifier;
  }

  /**
   *
   * Lend from: http://de.php.net/manual/de/function.implode.php#96100
   * Thanks kromped!
   * @param unknown_type $glue
   * @param unknown_type $pieces
   */
  private function recursiveImplode( $glue, $pieces )
  {
    $retVal = array();

    foreach( $pieces as $r_pieces )
    {
      if( is_array( $r_pieces ) )
      {
        ksort($r_pieces);
        $retVal[] = $this->recursiveImplode( $glue, $r_pieces );
      }
      else
      {
        $retVal[] = $r_pieces;
      }
    }
    return implode( $glue, $retVal );
  }

}