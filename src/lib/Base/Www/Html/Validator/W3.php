<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Base\Www\Html\Validator;

use Base\Www\Uri;

use Symfony\Component\HttpFoundation\Request;

use LiveTest\Connection\Request\Symfony;

use Base\Www\Html\Validator;
use Base\Www\Html\Document;
use Base\Http\Client\Client;

/**
 *
 * Class for validating markup using the
 * W3C validation service.
 *
 * @author Jan Brinkmann <lucky@the-luckyduck.de>
 */
class W3 implements Validator
{
  /**
   *
   * @var string validator URI
   */
  private $_validatorUri = 'http://validator.w3.org/check';

  /**
   *
   * @var Base\Http\Client\Client client used for validating
   */
  private $_httpClient = null;
  
  /**
   * @var Symfony
   */
  private $request;

  /**
   *
   * Create validator instance
   */
  public function __construct(Client $httpClient, $validatorUri = null)
  {
    // set alternative uri if needed
    if (!is_null($validatorUri)) {
        $this->_validatorUri = $validatorUri;
    }

    // prepare the injected http client
    $this->_httpClient = $httpClient;
  }

  /**
   *
   * @see Base\Validator.Html::validateHtml()
   *
   * @param string markup to validate
   * @return bool Is valid markup?
   */
  public function validate(Document $htmlDocument)
  {
    $rawDocument = $htmlDocument->getHtml();
    
    $postVars = array( 'output' => 'soap12', 'fragment' => $rawDocument);
    $request = Symfony::create(new Uri($this->_validatorUri), \Base\Http\Request\Request::POST, $postVars );

    $response = $this->_httpClient->request($request);

    return $this->_parseReponse($response->getBody());
  }

  /**
   *
   * @param string xml reponse from validator
   * @return bool valid?
   */
  private function _parseReponse($soapReponse)
  {
    // parse reponse
    $dom = new \DOMDocument();
    if (@$dom->loadXML($soapReponse) === false)
    {
      throw new \Exception('Not able to parse validator response');
    }

    // check for validity
    $validationResult = $dom->getElementsByTagName('validity');
    if ($validationResult->length
        && $validationResult->item(0)->nodeValue == 'true')
    {
      return true;
    }
    else
    {
      return false;
    }
  }
}