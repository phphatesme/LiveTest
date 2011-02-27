<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun;

use LiveTest\TestRun\Test;
use Base\Www\Uri;

/**
 * A test set contains a number of tests that will be run on a spefific uri.
 *
 * @author Nils Langner
 */
class TestSet
{
  /**
   * The uri for this test set
   * @var Uri
   */
  private $uri;

  /**
   * The tests
   * @var Test[]
   */
  private $tests = array ();

  public function __construct(Uri $uri)
  {
    $this->uri = $uri;
  }

  /**
   * Returns the uri of this test set.
   *
   * @return Uri
   */
  public function getUri()
  {
    return $this->uri;
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