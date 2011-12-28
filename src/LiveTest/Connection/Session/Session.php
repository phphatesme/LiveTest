<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Connection\Session;

use LiveTest\Connection\Request\Request;

/**
 * This class contains all information about the tests and the depending pages.
 *
 * @author Nils Langner
 */
use LiveTest\Config\PageManipulator\PageManipulator;

class Session
{
  private $pageRequests = array ();
  private $allowCookies;

  public function __construct($allowCookies = false)
  {
    $this->allowCookies = $allowCookies;
  }

  public function includePageRequest(Request $pageRequest)
  {
    $this->pageRequests[] = $pageRequest;
  }

  public function includePageRequests(array $pageRequests)
  {
    foreach ($pageRequests as $pageRequest)
    {
      $this->includePageRequest($pageRequest);
    }
  }

  public function getPageRequests()
  {
    return $this->pageRequests;
  }

  public function areCookiesAllowed()
  {
    return $this->allowCookies;
  }
}