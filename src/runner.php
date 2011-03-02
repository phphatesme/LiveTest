<?php

use LiveTest\Event\Dispatcher;
use LiveTest\Cli\Runner;
use Base\Cli\ArgumentConverter;

error_reporting(E_ALL);

include 'bootstrap.php';

echo "\nLiveTest 0.1.0 by Nils Langner & Mike Lohmann\n\n"; // (visit http://livetest.phphatesme.com)\n\n";

try
{
  $eventDispatcher = new Dispatcher();
  $converter = new ArgumentConverter($_SERVER['argv'], '--');
  $runner = new Runner($converter->getArguments(), $eventDispatcher);
  if ($runner->isRunAllowed())
  {
    $runner->run();
  }
}
// @todo this should be done within another class
catch ( Exception $e )
{
  if( $eventDispatcher->notify('LiveTest.Runner.Error', array( 'exception' => $e )))
  {
    echo "  An error occured: " . $e->getMessage() . " (" . get_class($e) . ")";
  }
}
echo "\n\n";