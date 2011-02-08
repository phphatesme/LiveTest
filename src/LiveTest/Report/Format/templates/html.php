<?php 
  function getHtmlContent($curResult)
  {
    switch ($curResult->getStatus()) 
    {
      case \LiveTest\TestRun\Result\Result::STATUS_SUCCESS: 
        $content['css_class'] = 'result_success';
        $content['message'] = $curResult->getMessage();
        break;
      case \LiveTest\TestRun\Result\Result::STATUS_FAILED: 
        $content['css_class'] = 'result_failed';
        $content['message'] = $curResult->getMessage();
        break;
      case \LiveTest\TestRun\Result\Result::STATUS_ERROR: 
        $content['css_class'] = 'result_error';
        $content['message'] = $curResult->getMessage();
        break;
      default: 
        $content['css_class'] = 'result_none';
        $content['message'] = '';
        break;
    }
    return $content;
  }

  function getRowClass($status)
  {
    switch($status) 
    {
      case 1: return 'url_success';
      case 2: return 'url_failed';
      case 3: return 'url_error';
	}
  }    
?>

<html>
<head>
	<title>LiveTest | Html Report</title>
	<link rel="stylesheet" media="all" type="text/css" href="http://www.phphatesme.com/LiveTest/report.css" />
</head>
<body>
	<table>
		<tr>
			<td></td>
    	    <?php foreach ( $tests as $test ): ?>
    		<td>
        		<b><?php echo $test->getName(); ?></b><br/>
        		<?php echo $test->getClassName()?>
    		</td>
    	    <?php endforeach;?>
    	</tr>
    	<?php foreach ($matrix as $url => $testInfo): $testList = $testInfo['tests']; ?>
    	<tr>
    		<td class="url_column <?php echo getRowClass( $testInfo['status'] );?>">
    			<a href="<?php echo $url ?>" target="_blank"><?php echo $url; ?></a>
    		</td>
  			<?php foreach ($tests as $test): $content = getHtmlContent( $testList[$test->getName()] ); ?>    				
				  <td class="<?php echo $content['css_class']; ?> result_column"><?php echo $content['message']; ?></td>					  			
  			<?php endforeach; ?>
    	</tr>
    	<?php endforeach; ?>    
    	<tr>
    		<td></td>
    		<td colspan="2" id="copyright">
    			Html Report by <b><a href="http://livetest.phphatesme.com">LiveTest</a></b>
    		</td>
    	</tr>		
	</table>
</body>
</html>