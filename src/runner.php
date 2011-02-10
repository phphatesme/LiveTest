<?php

use LiveTest\Cli\Runner;
use Base\Cli\ArgumentConverter;

include 'bootstrap.php';

echo "\nLiveTest 0.1.0 by Nils Langner & Mike Lohmann\n\n"; // (visit http://livetest.phphatesme.com)\n\n";


try
{
  $converter = new ArgumentConverter($_SERVER['argv'], '--');
  $runner = new Runner($converter->getArguments());
  $runner->run();
}
catch ( Base\Cli\MissingArgumentException $e )
{
  echo ' A mandatory argument is missing: ' . $e->getArgument() . "\n";
  echo " Please use --help for more information. \n\n";
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