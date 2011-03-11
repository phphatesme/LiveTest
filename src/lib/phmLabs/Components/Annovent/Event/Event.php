<?php

namespace phmLabs\Components\Annovent\Event;

interface Event
{
  public function getName();
  public function getParameters();
  public function setProcessed();
  public function isProcessed();
  public function interruptChain();
  public function isChainCompleted();
}