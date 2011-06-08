<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Base\Http\Client;

use Base\Http\Request\Request;

interface Client
{
  public function request(Request $request);
  public function setTimeout($timeInSeconds);

  //  public function request($method = null);
//  public function setUri($requestUri);
//  public function setParameterPost($name, $value = null);
//  public function setParameterGet($name, $value = null);
}