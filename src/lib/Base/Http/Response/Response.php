<?php

namespace Base\Http\Response;

interface Response
{
  public function getStatus();
  public function getBody();
  public function getDuration();
}