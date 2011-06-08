<?php

namespace Base\Http\Request;

interface Request
{
	const POST = 'post';
	const GET = 'get';
	
  public function getUri();
  public function getMethod();
  public function getParameters();
}