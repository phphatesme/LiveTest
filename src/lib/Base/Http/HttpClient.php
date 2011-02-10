<?php
namespace Base\Http;

interface HttpClient
{
  public function request($method = null);
}