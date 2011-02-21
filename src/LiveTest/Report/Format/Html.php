<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Information;

use LiveTest\TestRun\Result\ResultSet;
use LiveTest\TestRun\Result\Result;

class Html implements Format
{
  private $standardTemplate = '/templates/html.php';

  private $content;
  private $template;
  private $statuses;

  public function __construct()
  {
    $this->statuses = array (Result::STATUS_SUCCESS => 1, Result::STATUS_FAILED => 2, Result::STATUS_ERROR => 3 );
    $this->template = __DIR__ . $this->standardTemplate;
  }

  public function init($template = null)
  {
    if (!is_null($template))
    {
      $this->template = $template;
    }
  }

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
    $this->content = ob_get_contents();
    ob_clean();

    return $this->content;
  }
}