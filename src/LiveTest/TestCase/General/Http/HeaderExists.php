<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestCase\General\Http;

use Base\Www\Uri;
use Base\Http\Response\Response;

use LiveTest\TestCase\TestCase;
use LiveTest\TestCase\Exception;

/**
 * This test case checks if a specified http header is existing
 *
 * @author Nils Langner
 */
class HeaderExists implements TestCase
{
	private $headerName;

	/**
	 * Sets the header key
	 *
	 * @param string $headerName
	 */
	public function init( $headerName )
	{
		$this->headerName = $headerName;
	}

  /**
   * Checks if a specified http header is existing
   *
   * @see LiveTest\TestCase.HttpTestCase::test()
   */
  public function test(Response $response, Uri $uri)
  {
  	if( !( array_key_exists($this->headerName, $response->getHeaders())))
  	{
			throw new Exception('The expected header "'.$this->headerName.'" was not found.');
  	}
  }
}
