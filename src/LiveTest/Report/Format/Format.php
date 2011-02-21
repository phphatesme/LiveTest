<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Information;
use LiveTest\TestRun\Result\ResultSet;

interface Format
{
  public function formatSet(ResultSet $set, array $connectionStatuses, Information $information);
}