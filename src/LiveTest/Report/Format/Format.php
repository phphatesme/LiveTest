<?php

namespace LiveTest\Report\Format;

use LiveTest\TestRun\Result\ResultSet;

interface Format
{
  public function formatSet(ResultSet $set);
}