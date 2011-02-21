<?php

/**
 * developed by Mike Lohman
*/
use Annovent\Event\Dispatcher;
use LiveTest\Cli\Runner;
use Base\Cli\ArgumentConverter;

error_reporting(E_ALL);

include 'bootstrap.php';

echo "\nLiveTest 0.1.0 by Nils Langner & Mike Lohmann\n\n"; // (visit http://livetest.phphatesme.com)\n\n";

try
{
  $converter = new ArgumentConverter($_SERVER['argv'], '--');
  $runner = new Runner($converter->getArguments(), new Dispatcher());
  if ($runner->isRunAllowed())
  {
    $runner->run();
  }
}
catch ( Exception $e )
{
  if ($converter->hasArgument('debug'))
  {
    throw $e;
  }
  else
  {
    echo "  An error occured: " . $e->getMessage() . " (" . get_class($e) . ")\n\n";
  }
}
echo "\n\n";