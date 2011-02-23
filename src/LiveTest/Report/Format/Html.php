<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Information;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

/**
 * This format converts the given results into a html template. 
 * 
 * @author Nils Langner
 */

class Html implements Format
{
  private $standardTemplate = '/templates/html.php';

  /**
   * The html template used for rendering
   * @var string
   */
  private $template;
  
  /**
   * An ordered list of all result statuses
   * @var array
   */
  private $statuses;

  /**
   * This constructor sets the standard values for the html template and the result status order.
   */
  public function __construct()
  {
    $this->statuses = array (Result::STATUS_SUCCESS => 1, Result::STATUS_FAILED => 2, Result::STATUS_ERROR => 3 );
    $this->template = __DIR__ . $this->standardTemplate;
  }

  /**
   * Sets the template.
   * 
   * @param string $template
   */
  public function init($template = null)
  {
    if (!is_null($template))
    {
      $this->template = $template;
    }
  }

  /**
   * Formats the given results to a html document.
   * 
   * @param ResultSet $set
   * @param array $connectionStatuses
   * @param Information $information
   * 
   * @return string
   */
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information)
  {
    $matrix = array ();
    $tests = array ();
    $testCount = 0;

    foreach ( $set->getResults() as $result )
    {
      $testCount++;
      $matrix [$result->getUri()->toString()] ['tests'] [$result->getTest()->getName()] = $result;
      if (array_key_exists('status', $matrix [$result->getUri()->toString()]))
      {
        $matrix [$result->getUri()->toString()] ['status'] = max($matrix [$result->getUri()->toString()] ['status'], $this->statuses [$result->getStatus()]);
      }
      else
      {
        $matrix [$result->getUri()->toString()] ['status'] = $this->statuses [$result->getStatus()];
      }
      $tests [$result->getTest()->getName()] = $result->getTest();
    }

    ob_start();
    require $this->template;
    $content = ob_get_contents();
    ob_clean();

    return $content;
  }
}