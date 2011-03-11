<?php

namespace phmLabs\Components\Annovent\Event;

interface Event
{
  public function getName();
  public function getParameters();
  public function setIsProcessed();
  public function isProcessed();
}