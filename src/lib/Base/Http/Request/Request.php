<?php

namespace Base\Http\Request;

interface Request
{
  public function getUri();
  public function getMethod();
  public function getParameters();
}