<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use LiveTest\Connection\Session\Session;

use Base\Http\Request\Request;

use LiveTest\TestRun\Test;

/**
 * A test set contains a number of tests that will be run on a spefific uri.
 *
 * @todo this class should implement the iterator interface. (create Base\Collection\Set)
 *
 * @author Nils Langner
 */
class TestSet
{
  /**
   * The request for this test set
   * @var Request
   */
  private $request;

  /**
   * The tests
   * @var Test[]
   */
  private $tests = array ();

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  /**
   * Returns the request of this test set.
   *
   * @return Request
   */
  public function getRequest()
  {
    return $this->request;
  }

  /**
   * Add a test to this set
   *
   * @param Test $test
   */
  public function addTest(Test $test)
  {
    $this->tests[] = $test;
  }

  /**
   * Returns the number of tests
   *
   * @return int
   */
  public function getTestCount()
  {
    return count($this->tests);
  }

  /**
   * Returns a set of tests
   *
   * @return Test[]
   */
  public function getTests()
  {
    return $this->tests;
  }
}