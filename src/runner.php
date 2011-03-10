<?php

use LiveTest\Event\Dispatcher;
use LiveTest\Cli\Runner;
use Base\Cli\ArgumentConverter;

error_reporting(E_ALL);

include 'bootstrap.php';

echo "\nLiveTest 0.1.0 by Nils Langner & Mike Lohmann\n\n"; // (visit http://livetest.phphatesme.com)\n\n";

try
{
  $converter = new ArgumentConverter($_SERVER['argv'], '--');

  if ($converter->hasArgument('bootstrap'))
  {
    // @todo this should be done somewhere else
    // @todo this must be more defensive
    include_once $converter->getArgument('bootstrap');
  }

  $dispatcher = new Dispatcher();
  $runner = new Runner($converter->getArguments(), $dispatcher);
  if ($runner->isRunAllowed())
  {
    $runner->run();
  }
}
catch ( Exception $e )
{
  $dispatcher->notify('LiveTest.Runner.Error', array ('exception' => $e ));
  if ($converter->hasArgument('debug'))
  {
    throw $e;
  }
  else
  {
    echo "  An error occured: " . $e->getMessage() . " (" . get_class($e) . ")";
  }
}
echo "\n\n";