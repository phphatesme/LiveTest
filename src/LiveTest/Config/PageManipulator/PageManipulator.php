<?php

namespace LiveTest\Config\PageManipulator;

use Symfony\Component\HttpFoundation\Request;

interface PageManipulator
{
  public function manipulate(Symfony\Component\HttpFoundation\Request $urlString);
}