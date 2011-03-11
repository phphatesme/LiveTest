<?php

namespace Unit\LiveTest\Listener;

use LiveTest\Event\Dispatcher;

use LiveTest\Listener\Listener;

class MockUp implements Listener
{
  private $dispatcher;
  private $runId;

  private $foo;

  public function __construct($runId, Dispatcher $eventDispatcher)
  {
    $this->runId = $runId;
    $this->dispatcher = $eventDispatcher;
  }

  public function init( $foo )
  {
    $this->foo = $foo;
  }

  public function getFoo( )
  {
    return $this->foo;
  }
}