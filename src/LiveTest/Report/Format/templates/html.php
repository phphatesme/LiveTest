<?php

/*
 * This file is part of the LiveTest package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
  include_once 'html_functions.php'; 
?>

<html>
<head>
	<title>LiveTest | Html Report</title>
	<link rel="stylesheet" media="all" type="text/css" href="http://www.phphatesme.com/LiveTest/report.css" />
</head>
<body>
  <table>
    <tr>
      <td id="legend">Run Information</td>
      <td>Date: <?php echo date( 'Y-m-d H:i:m'); ?></td>
    </tr>
    <tr>
      <td></td>
      <td>Default Domain: <b><?php echo $information->getDefaultDomain(); ?></b></td>
    </tr>
    <tr>
      <td></td>
      <td>Duration: <b><?php echo $information->getDuration(); ?></b> second(s)</td>
    </tr>
    <tr>
      <td></td>
      <td>Number of Tests: <b><?php echo $testCount; ?></b></td>
    </tr>    
    <tr style="height: 30px"><td></td></tr>
    <tr>
      <td id="legend">Legend</td>
      <td class="result_success result_column">Success</td>     
    </tr>
    <tr>
      <td></td>
      <td class="result_failed result_column">Failure</td>
    </tr>
    <tr>
      <td></td>
      <td class="result_error result_column">Error</td>
    </tr>
    <?php if( count( $connectionStatuses ) > 0 ): ?> 
    <tr style="height: 30px"><td></td></tr>
    <tr>
    	<td id="legend" valign="top">Connection Errors</td>
    	<td>
    	<?php foreach ($connectionStatuses as $status ):?>
    		<li><a href="<?php echo $status->getUri()->toString(); ?>"><?php echo $status->getUri()->toString(); ?></a></li>
    	<?php endforeach; ?>
    	</td>
	<?php endif; ?>    	
    <tr style="height: 30px"><td></td></tr>
		<tr>
			<td></td>
    	    <?php foreach ( $tests as $test ): ?>
    		<td class="test_label">
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
  			<?php foreach ($tests as $test): 
  			      if( array_key_exists($test->getName(), $testList) ) {
  			        $content = getHtmlContent( $testList[$test->getName()] );
  			      }else{
  			        $content = array( 'css_class'=> 'result_none', 'message' => ''); 
  			      }
  			?>  			            				
				  <td class="<?php echo $content['css_class']; ?> result_column"><?php echo htmlentities($content['message']); ?></td>					  			
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
