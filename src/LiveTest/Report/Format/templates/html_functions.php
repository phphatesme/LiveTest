<?php

function getHtmlContent($curResult)
{
  switch ($curResult->getStatus())
  {
    case \LiveTest\TestRun\Result\Result::STATUS_SUCCESS :
      $content['css_class'] = 'result_success';
      $content['message'] = $curResult->getMessage();
      break;
    case \LiveTest\TestRun\Result\Result::STATUS_FAILED :
      $content['css_class'] = 'result_failed';
      $content['message'] = $curResult->getMessage();
      break;
    case \LiveTest\TestRun\Result\Result::STATUS_ERROR :
      $content['css_class'] = 'result_error';
      $content['message'] = $curResult->getMessage();
      break;
    default :
      $content['css_class'] = 'result_none';
      $content['message'] = '';
      break;
  }
  return $content;
}

function getRowClass($status)
{
  switch ($status)
  {
    case 1 :
      return 'url_success';
    case 2 :
      return 'url_failed';
    case 3 :
      return 'url_error';
  }
}
