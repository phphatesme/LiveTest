<?php

namespace Base\Http\Request;

interface Request
{
  public function getBasePath();
  public function getBaseUrl();
  public function getMethod();
  public function getUri();
  public function getRequestUri();
  public function getIdentifier(); //@todo: in LiveTestInterface
}