<?php

// @todo default config must be set here
use phmLabs\Components\Annovent\Event\Event;
use LiveTest\MandatoryParameterException;
use LiveTest\Event\Dispatcher;
use LiveTest\Packages\Runner\Listeners\Help;

include_once __DIR__.'/version.php';
include_once __DIR__.'/bootstrap.php';

$exitStatusCode = 1;

try
{
  $converter = new Base\Cli\ArgumentConverter($_SERVER['argv'], '--');

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

  $dispatcher = new LiveTest\Event\Dispatcher();

  $runner = new LiveTest\Cli\Runner($converter->getArguments(), $dispatcher);
  if ($runner->isRunAllowed())
  {
    $runner->run();
  }
  $exitStatusCode = 0;
}
catch ( Livetest\ConfigurationException $e )
{
  $dispatcher->simpleNotify('LiveTest.Configuration.Exception', array ('exception' => $e ));
}
catch ( Exception $e )
{
  $event = new phmLabs\Components\Annovent\Event\Event('LiveTest.Runner.Error', array ('exception' => $e ));
  $dispatcher->notify($event);
  if (!$event->isProcessed())
  {
    echo 'An error occured: ' . $e->getMessage() . '(' . get_class($e) . ')';
  }
}
echo "\n\n";
exit($exitStatusCode);