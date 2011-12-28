<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Config\Tags\TestSuite;

/**
 * This tag adds the test cases to the configuration. All tags that are not known withing this class are
 * handled by the parser.
 *
 * @example
 * TestCases:
 *  TextPresent_body:
 *   TestCase: LiveTest\TestCase\General\Html\TextPresent
 *   Parameter:
 *    text: "unpresent_text"
 *
 * @author Nils Langner
 */
class TestCases extends Base
{
  /**
   * @see LiveTest\Config\Tags\TestSuite.Base::doProcess()
   */
  protected function doProcess(\LiveTest\Config\TestSuite $config, $parameters)
  {
    foreach ( $parameters as $testCaseName => $value )
    {
      if (array_key_exists('Parameter', $value))
      {
        $testParameters = $value['Parameter'];
        unset($value['Parameter']);
      }
      else
      {
        $testParameters = array ();
      }

      $config->createTestCase($testCaseName, $value['TestCase'], $testParameters);
      unset($value['TestCase']);

      $this->getParser()->parse($value, $config);
    }
  }
}