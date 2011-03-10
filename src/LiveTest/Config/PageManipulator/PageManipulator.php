<?php

namespace LiveTest\Config\PageManipulator;

interface PageManipulator
{
  public function manipulate($urlString);
}