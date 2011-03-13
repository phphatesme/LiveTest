<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestCase\General\Html;

use Base\Service\W3\Adapter\ZendHttp;
use Base\Www\Html\Document;
use LiveTest\TestCase\Exception;

/**
 * This test case validates the given markup.
 *
 * @author luckyduck networks - Jan Brinkmann
 * @example:
 *  ValidMarkup_html:
 *   TestCase: LiveTest\TestCase\General\Html\ValidMarkup
 *
 */
class ValidMarkup extends TestCase
{
  /**
   *
   * @var Base\Service\W3\Base The used markup validator
   */
  private $_validator = null;

  /**
   *
   * @var int Seconds between API calls
   */
  private $_sleep = 1;

  /**
   * Initialize the validation webservice
   *
   * @param string URI of an alternative validation service
   * @param int Seconds between API calls
   */
  public function init($validatorUri = null, $sleep = 1)
  {
    $this->_validator = new ZendHttp($validatorUri);
    $this->_sleep = $sleep;
  }

  /**
   * Validate the markup using the given validator
   *
   * @see LiveTest\TestCase\General\Html.TestCase::runTest()
   */
  protected function runTest(Document $htmlDocument)
  {
    $htmlCode = $htmlDocument->getHtml();
    if ($this->_validator->validateHtml($htmlCode) === false)
    {
      throw new Exception('The document contains invalid markup.');
    }

    // Be nice
    sleep($this->_sleep);
  }
}