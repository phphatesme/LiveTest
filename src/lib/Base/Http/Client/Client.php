<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Base\Http\Client;

interface Client
{
  public function request($method = null);
  public function setTimeout($timeInSeconds);
  public function setUri($requestUri);
  public function setParameterPost($paramName, $paramValue);
  public function setParameterGet($paramName, $paramValue);
}