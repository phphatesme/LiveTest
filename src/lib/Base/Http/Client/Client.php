<?php

namespace Base\Http\Client;

interface Client
{
  public function request($method = null);
}