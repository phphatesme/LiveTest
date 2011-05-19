<?php

namespace LiveTest\Config\Request;

use Base\Www\Uri;

use Base\ArrayLists\Recursive;

use LiveTest\Exception;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Base\Http\Request\Request as RequestInterface;

class Symfony implements RequestInterface
{

  private $identifier;
  private $request;
  private $parameters;

  public function __construct(SymfonyRequest $request, $parameters)
  {
    $this->request = $request;
    $this->parameters = $parameters;
    $this->setIdentifier($parameters);
  }

 /**
   *
   * Enter description here ...
   * @param array $parameters
   */
  public static function createRequestsFromParameters(array $parameters, Uri $baseUri)
  {
    if(count($parameters) == 0)
    {
      throw new Exception('Parameter has to be set.');
    }

    $requests = array();
    $preparedRequestParameters = self::prepareRequestParameters($parameters);

    foreach($preparedRequestParameters as $aPreparedParameter)
    {
      $requests[] = self::create($baseUri->concatUri($parameters['uri']),
                                  $parameters['method'],
                                  $parameters['parameters']);
    }

    return $requests;
  }

  public static function create(Uri $uri,
                                $method = 'get',
                                array $requestParameters)
  {
    $request =  SymfonyRequest::create($uri->toString(),
                          $method,
                          $requestParameters);

    return new static($request, $requestParameters);
  }

  private function setIdentifier(array $parameters)
  {
    $this->identifier = md5(Recursive::implode('_',$parameters));
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
     $mergedParameters = array();

     $defaults = array(
            'uri'          => '',
            'method' => 'get',
            'parameters' => array(),
        );

    $mergedParameters['uri'] = $uri;


    if(key_exists('get', $parameters) ||
       key_exists('post', $parameters))
    {
      $method = array_keys($parameters);
      $mergedParameters['method'] = $method[0];

      $requestParameters = $parameters[$mergedParameters['method']];

      if(count($requestParameters) > 0)
      {
        $mergedParameters['parameters'] = $requestParameters;
      }
    }

    return  array_merge($defaults, $parameters);
  }

  public function getMethod()
  {
    $this->request->getMethod();
  }

  public function getUri()
  {
    $this->request->getUri();
  }

  public function getIdentifier()
  {
    return $this->identifier;
  }

  public function getParameters()
  {
    return $this->identifier;
  }
}