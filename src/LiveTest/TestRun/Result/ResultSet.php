<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\TestRun\Result;

/**
 * This class is a collection of test results.
 *
 * @todo this class should implement the iterator interface.
 *
 * @author Nils Langner
 */
class ResultSet
{
  /**
   * Array containing all results
   * @var Result[]
   */
  private $results = array();

  /**
   * The status of the set. The status is the most severe status of the
   * containing results.
   */
  private $status;

  /**
   * The weight of the statuses. Used to calculate the set status.
   * @var array
   */
  private $statusWeight = array( );

  public function __construct()
  {
    $this->statusWeight = array( Result::STATUS_SUCCESS => 0,
                                 Result::STATUS_FAILED => 1,
                                 Result::STATUS_ERROR => 2 );

    $this->status = $this->statusWeight[Result::STATUS_SUCCESS];
  }

  /**
   * Adds a result to the set
   *
   * @param Result $result
   */
  public function addResult(Result $result)
  {
    $this->status = max($this->statusWeight[$result->getStatus()], $this->status);
    $this->results[] = $result;
  }

  /**
   * Returns the calculated status of this set.
   *
   * @return string
   */
  public function getStatus()
  {
    foreach($this->statusWeight as $key => $value )
    {
      if ($value == $this->status) {
        return $key;
      }
    }
  }

  /**
   * Returns the number of added results.
   *
   * @return int
   */
  public function getResultCount()
  {
    return count($this->results);
  }

  /**
   * Returns an array with all addecresults.
   *
   * @return Result[]
   */
  public function getResults()
  {
    return $this->results;
  }
}
