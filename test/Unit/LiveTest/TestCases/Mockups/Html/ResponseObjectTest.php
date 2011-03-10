<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unit\LiveTest\TestCases\Mockups\Html;

use LiveTest\TestCase\General\Html\TestCase;
use Base\Www\Html\Document;

/**
 * This test case is used to check for an speficed http status code.
 *
 * @author Mike Lohmann
 */
class ResponseObjectTest extends TestCase
{
	public function init()
	{
		//nothing to do yet
	}
	
 	protected function runTest(Document $htmlDocument)
 	{
 		//just call getHttpResponse
 		$this->getHttpResponse();
 	}
}