<?php

namespace Base\Http\Request;

use LiveTest\Exception;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Base\Http\Request\Request as RequestInterface;

class PhmLabs extends SymfonyRequest implements RequestInterface
{
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
      
      $requests[] = parent::create(
                  $aPreparedParameter['uri'], 
                  $aPreparedParameter['requestType'],
                  $aPreparedParameter['requestParameter']);
    }
    
    return $requests;
  }
  
  private static function prepareRequestParameters(array $parameters)
  {
    $mergedRequestParameters = array();
    $defaults = array(
            'uri'          => '',
            'requestType' => 'get',
            'requestParameter' => array(),
        );
    
    foreach($parameters as $aRequest)
    {
      foreach($aRequest as $uri => $requestParameters)
      {
        $requestParameters['uri'] = $uri;
        $mergedRequestParameters[] = array_merge($defaults, $requestParameters);
        
      }
    }
    
    return $mergedRequestParameters;
  }
}