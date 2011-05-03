<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestCase\General\Html;

use Base\Www\Html\Validator\W3;
use Base\Www\Html\Document;
use LiveTest\TestCase\Exception;

/**
 * This test case validates the given markup.
 *
 * @author Jan Brinkmann <lucky@the-luckyduck.de>
 * @example:
 *  ValidMarkup_html:
 *   TestCase: LiveTest\TestCase\General\Html\ValidMarkup
 *
 */
class ValidMarkup extends TestCase
{
  /**
   *
   * @var Base\Www\Html\Validator The used validator
   */
  private $_validator = null;

  /**
   * Initialize the validation webservice
   *
   * @param string URI of an alternative validation service
   * @param int Seconds between API calls
   * @todo check if Validator can be injected into init
   */
  public function init($validatorUri = null)
  {
    // prepare http client
    $httpClient = new \Base\Http\Client\Zend();

    // create validator and inject http client
    $this->_validator = new W3($httpClient, $validatorUri);
  }

  /**
   * Validate the markup using the given validator
   *
   * @see LiveTest\TestCase\General\Html.TestCase::runTest()
   */
  protected function runTest(Document $htmlDocument)
  {
    if ($this->_validator->validate($htmlDocument) === false)
    {
      throw new Exception('The document contains invalid markup.');
    }
  }
}