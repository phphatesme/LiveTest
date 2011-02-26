<?php

namespace Base\Http\Response;

interface Response
{
  public function getStatus();
  public function getBody();
  public function getDuration();

  public function getHeader($header);
  public function getHeaders();
}