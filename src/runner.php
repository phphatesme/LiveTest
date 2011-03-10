<?php

use LiveTest\Event\Dispatcher;
use LiveTest\Cli\Runner;
use Base\Cli\ArgumentConverter;

error_reporting(E_ALL);

include 'bootstrap.php';

echo "\nLiveTest 0.8.4 by Nils Langner & Mike Lohmann\n\n"; // (visit http://livetest.phphatesme.com)\n\n";

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
      echo '  Bootstrap file (' . $converter->getArgument('bootstrap') . ') not found.'."\n\n";
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
  $dispatcher->notify('LiveTest.Runner.Error', array('exception' => $e));
}
echo "\n\n";