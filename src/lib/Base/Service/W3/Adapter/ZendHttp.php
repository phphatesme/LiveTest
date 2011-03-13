<?php

namespace Base\Service\W3\Adapter;

use Base\Service\W3\Base;

/**
 *
 * Class for validating markup using the
 * W3C validation service.
 *
 * @author luckyduck networks - Jan Brinkmann
 */
class ZendHttp implements Base
{
    /**
     *
     * @var string validator URI
     */
    private $_validatorUri = 'http://validator.w3.org/check';

    /**
     *
     * @var Zend_Http_Client client used for validating
     */
    private $_httpClient = null;

    /**
     *
     * Create validator instance
     */
    public function __construct($validatorUri = null)
    {
        // set alternative uri if needed
        if (!is_null($validatorUri)) {
            $this->_validatorUri = $validatorUri;
        }

        // create soap client
        $this->_httpClient = new \Zend_Http_Client();
        $this->_httpClient->setUri($this->_validatorUri);

        // set options
        $this->_httpClient->setParameterPost('output', 'soap12');
    }

    /**
     *
     * @see Base\Validator.Html::validateHtml()
     *
     * @param string markup to validate
     * @return bool Is valid markup?
     */
    public function validateHtml($htmlDocument)
    {
        $this->_httpClient->setParameterPost('fragment',$htmlDocument);
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
        if (!@$dom->loadXML($soapReponse))
        {
            throw new \Exception('Not able to parse validator response');
        }

        // check for validity
        $validationResult = $dom->getElementsByTagName('validity');
        if ($validationResult->length
            && $validationResult->item(0)->nodeValue == 'true'
        ) {
            return true;
        }
        else
       {
            return false;
        }
    }
}

?>