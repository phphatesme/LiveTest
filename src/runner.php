<?php

use Annovent\Event\Event;
use LiveTest\Event\Dispatcher;
use LiveTest\Cli\Runner;
use Base\Cli\ArgumentConverter;

// @todo this must be defined somewhere else
define('LIVETEST_VERSION', '0.8.4');

include 'bootstrap.php';

echo "\nLiveTest " . LIVETEST_VERSION . " by Nils Langner & Mike Lohmann\n\n"; // (visit http://livetest.phphatesme.com)\n\n";

try
{
  $converter = new ArgumentConverter($_SERVER['argv'], '--');

  // @todo this should be done in another class/function
  if ($converter->hasArgument('bootstrap'))
  {
    $bootstrapFile = $converter->getArgument('bootstrap');

    if (file_exists(getcwd() . DIRECTORY_SEPARATOR . $bootstrapFile) && $bootstrapFile != '')
    {
      include_once $converter->getArgument('bootstrap');
    }
    else
    {
      echo '  Bootstrap file (' . $converter->getArgument('bootstrap') . ') not found.' . "\n\n";
    }
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
  $event = new Event('LiveTest.Runner.Error', array('exception' => $e));
  $dispatcher->notifyEvent($event);
  if (!$event->isProcessed())
  {
    echo 'An error occured: '.$e->getMessage() . '('.get_class($e).')';
  }
}
echo "\n\n";