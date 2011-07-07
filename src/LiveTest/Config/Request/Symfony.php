<?php

namespace LiveTest\Config\Request;

use Base\Http\Request\Request as BaseRequest;
use Base\Www\Uri;
use Base\ArrayLists\Recursive;

use LiveTest\Exception;

use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Symfony implements Request
{
  /**
   * Contains the Unique-Id for every Request, composed setIdentifier();
   * @var string $identifier
   */
  private $identifier;

  /**
   * Holds the delegated SymfonyRequest-Object.
   *
   * @var SymfonyRequest $request
   */
  private $request;

  /**
   * @var array $parameters
   */
  private $parameters;

  /**
   * Constructor for new Requests.
   *
   * @param SymfonyRequest $request
   * @param array $parameters
   */
  public function __construct(SymfonyRequest $request, array $parameters)
  {
    $this->request = $request;
    ksort($parameters);
    $this->parameters = $parameters;
    $this->setIdentifier(array ($request->getUri(), $request->getMethod(), array_keys($parameters), array_values($parameters)));
  }

  /**
   * Creates Requests from a list of urls. If $baseUri is given, urls are merged with baseUri.
   *
   * @param array $parameters
   * @param Uri $baseUri
   */
  public static function createRequestsFromParameters(array $parameters, Uri $baseUri = null)
  {
    if (count($parameters) == 0)
    {
      throw new Exception('Parameter has to be set.');
    }

    $requests = array ();
    $preparedRequestParameters = self::prepareRequestParameters($parameters);

    foreach ($preparedRequestParameters as $aPreparedParameter)
    {

      if ($baseUri == null)
      {
        $uri = new Uri($aPreparedParameter['uri']);
      }
      else
      {
        $uri = $baseUri->concatUri($aPreparedParameter['uri']);
      }

      $requests[] = self::create($uri, $aPreparedParameter['method'], $aPreparedParameter['parameters']);
    }

    return $requests;
  }

  /**
   * Creates new LiveTest-Symfony-Requests by using (delegation) the
   * original SymfonyRequest.
   *
   * @param Uri $uri
   * @param String $method
   * @param array $requestParameters
   */
  public static function create(Uri $uri, $method = 'get', $requestParameters = array())
  {
    $request = SymfonyRequest::create($uri->toString(), $method, $requestParameters);

    return new static($request, $requestParameters);
  }

  /**
   * Sets the unique identifier for each request
   *
   * @param array $parameters
   * @throws \Exception
   */
  private function setIdentifier(array $parameters)
  {
    $this->identifier = Recursive::implode('_', $parameters);
  }

  /**
   * Decides which kind of parameters for the request are allready set.
   * If only a list of Urls is given, the default ones are added.
   * Otherwise the given ones are used.
   *
   * @param array $parameters
   *
   * @return array $mergedParameters;
   */
  private static function prepareRequestParameters(array $parameters)
  {
    $mergedRequestParameters = array ();
    foreach ($parameters as $aRequest)
    {
      if (is_array($aRequest))
      {
        	$url = $aRequest["url"];
        	unset($aRequest["url"]);
          $mergedRequestParameters[] = self::getMergedRequestParameters($url, $aRequest);
      }
      else
      {
        $uri = $aRequest;
        $mergedRequestParameters[] = self::getMergedRequestParameters($uri, array ());
      }
    }
    return $mergedRequestParameters;
  }

  /**
   * Merges default set of parameters with given URI and $parameters
   *
   * @param String $uri
   * @param array $parameters
   *
   * @return array $mergesParameters
   */
  private static function getMergedRequestParameters($uri, array $parameters)
  {
    $mergedParameters = array ();

    $defaults = array ('uri' => '', 'method' => BaseRequest::GET, 'parameters' => array ());

    $mergedParameters['uri'] = $uri;

    if (key_exists(BaseRequest::GET, $parameters) || key_exists(BaseRequest::POST, $parameters))
    {
      $method = array_keys($parameters);
      $mergedParameters['method'] = $method[0];

      $requestParameters = $parameters[$mergedParameters['method']];

      if (count($requestParameters) > 0)
      {
        $mergedParameters['parameters'] = $requestParameters;
      }
    }

    return array_merge($defaults, $mergedParameters);
  }

  /**
   * @see Base\Http\Request.Request::getMethod()
   */
  public function getMethod()
  {
    return $this->request->getMethod();
  }

  /**
   * @see Base\Http\Request.Request::getUri()
   */
  public function getUri()
  {
    return $this->request->getUri();
  }

  /**
   * @see LiveTest\Config\Request.Request::getIdentifier()
   */
  public function getIdentifier()
  {
    return $this->identifier;
  }

  /**
   * @see Base\Http\Request.Request::getParameters()
   */
  public function getParameters()
  {
    return $this->parameters;
  }
}