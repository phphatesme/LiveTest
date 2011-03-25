<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Base\Www\Html\Validator;

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
    $this->_httpClient->setUri($this->_validatorUri);
    $this->_httpClient->setParameterPost('output', 'soap12');
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
      
    $this->_httpClient->setParameterPost('fragment',$rawDocument);
    $response = $this->_httpClient->request('POST');

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

?>