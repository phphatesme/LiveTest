<?php

namespace Base\Www\Html\Tag;

use Base\Www\Html\Exception;

class Head implements Tag
{
  const TAG_NAME = 'HEAD';
  
  private $content;
  
  private $title;
  
  public function __construct($htmlContent)
  {
    $this->content = $htmlContent;
  }
  
  public function getTagName()
  {
    return self::TAG_NAME;
  }
  
  public function hasTitle()
  {
    return is_null($this->extractTitle());
  }
  
  private function extractTitle()
  {
    if (is_null($this->title))
    {
      preg_match('/\<title\>(.*)\<\/title\>/', $this->content, $matches);
      if (!isset($matches[1]))
      {
        $this->title = null;
      }
      else
      {
        $this->title = $matches[1];
      }
    }
    return $this->title;
  }
  
  public function getTitle()
  {
    $title = $this->extractTitle();
    if (is_null($title))
    {
      throw new Exception('No title tag existing.');
    }
    return $title;
  }
}