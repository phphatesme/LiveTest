<?php

namespace LiveTest\TestCase\General\Html\Dom\XPath;

use LiveTest\ConfigurationException;

use LiveTest\TestCase\Exception;
use DOMXPath;

class Size extends TestCase
{
	private $xpath;
	private $minSize;
	private $maxSize;

	public function init($xpath, $minSize = null, $maxSize = null)
	{
		if(is_null($minSize) && is_null($maxSize))
		{
			throw new ConfigurationException('Neither minSoize nor maxSize is set.');
		}

		$this->minSize = $minSize;
		$this->maxSize = $maxSize;

		$this->xpath = $xpath;
	}

	public function doXPathTest(DOMXPath $domXPath)
	{
		$elements = $domXPath->query($this->xpath);
    if ($elements->length == 0)
    {
      throw new Exception('The given xpath ("' . $this->xpath . '") was not found.');
    }

    foreach( $elements as $element )
    {
      switch (get_class($element))
      {
        case 'DOMAttr':
          $value = $element->value;
          break;
        case 'DOMNode':
        case 'DOMElement':
          $value = $element->textContent;
      }

			$size = strlen($value);

      if( !is_null( $this->maxSize ) && $this->maxSize < $size )
      {
      	throw new Exception('The size of the xpath element ("'.$this->xpath.'") is too big (current: '.$size.', max: '.$this->maxSize.').');
      }

      if( !is_null( $this->minSize ) && $this->minSize > $size )
      {
      	throw new Exception('The size of the xpath element ("'.$this->xpath.'") is too small (current: '.$size.', min: '.$this->minSize.').');
      }


    }
	}
}