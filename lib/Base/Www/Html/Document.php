<?php

namespace Base\Www\Html;

use Base\Www\Uri;

use Base\Www\Html\Tag\Body;
use Base\Www\Html\Tag\Head;

class Document
{
  private $content;
  
  private $head;
  
  public function __construct($htmlContent)
  {
    $this->content = $htmlContent;
  }
  
  public function __toString()
  {
    return $this->getHtml();
  }
  
  /**
   * @return Base\Www\Html\Tag\Head
   */
  public function getHead()
  {
    $head = $this->extractHead();
    if (is_null($head))
    {
      throw new Exception('No head tag existing.');
    }
    else
    {
      return new Head($head);
    }
  }
  
  public function hasHead()
  {
    return !is_null($this->extractHead());
  }
  
  private function extractHead()
  {
    if (is_null($this->head))
    {
      $pattern = '/<head>(.*)\<\/head>/Us';
      preg_match($pattern, $this->getHtml(), $matches);
      
      if (!array_key_exists(1, $matches))
      {
        $this->head = null;
      }
      else
      {
        $this->head = $matches[1];
      }
    }
    return $this->head;
  }
  
  public function getBody()
  {
  }
  
  public function getHtml()
  {
    return $this->content;
  }
  
  public function getExternalDependencies($uri = null)
  {
    $pattern = '/[^\'](<link|<script).*(href|src)=["\']([\S]+)[\'"][^\']/i';
    $result = array();
    
    $matches = array();
    preg_match_all($pattern, $this->content, $matches);
    $files = $matches[3];
    
    if (!is_null($uri))
    {
      $uri = new Uri($uri);
      $cleanFiles = array();
      foreach ($files as $file)
      {
        $cleanFiles[] = $uri->concatUri( $file );
      }
    }
    else
    {
      $cleanFiles = $files;
    }
    return $cleanFiles;
  }
}