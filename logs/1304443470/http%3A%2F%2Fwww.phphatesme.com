
<!-- html head -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE">
<head>
	<style type="text/css" media="screen">
		@import url( http://www.phphatesme.com/wp-content/themes/phphatesme4_1/style.css );
		@import url( http://www.phphatesme.com/wp-content/themes/phphatesme4_1/css/home.css );
	</style>
	<script src="/extensions/jquery.js"></script>
	
	<meta name="robots" content="index, follow" />
	<meta http-equiv="Content-Language" content="de" />
	<meta name="verify-v1" content="ybPm66vP4agm8JLLTQJk87DzdqQVvOYpZBo5rhkRzMU=" />
	<link rel="alternate" type="application/rss+xml" title="RSS Feed" href="http://feeds2.feedburner.com/PhpHatesMe-DerPhpBlog" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="shortcut icon" href="http://www.phphatesme.com/favicon.ico" type="image/x-icon" />
	<title>PHP hates me - Der PHP Blog</title>
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.phphatesme.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.phphatesme.com/wp-includes/wlwmanifest.xml" /> 
<link rel='index' title='PHP hates me - Der PHP Blog' href='http://www.phphatesme.com' />
<meta name="generator" content="WordPress 2.9.2" />

<!-- all in one seo pack 1.4.9 [985,1032] -->
<link rel="canonical" href="http://www.phphatesme.com/" />
<!-- /all in one seo pack -->
<style type="text/css">
/* <![CDATA[ */
img.latex { vertical-align: middle; border: none; }
/* ]]> */
</style>
	<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-463885-11");
pageTracker._trackPageview();
var pageTracker = _gat._getTracker("UA-15786011-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</head>
<!-- html head ende --><body>
	
<!-- main menue start -->
<script type="text/javascript">
  var timeout    = 500;
  var closetimer = 0;
  var ddmenuitem = 0;

  function main_menu_open()
  {  main_menu_canceltimer();
     main_menu_close();
     ddmenuitem = $(this).find('div').css('visibility', 'visible');}

  function main_menu_close()
  {  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

  function main_menu_timer()
  {  closetimer = window.setTimeout(main_menu_close, timeout);}

  function main_menu_canceltimer()
  {  if(closetimer)
     {  window.clearTimeout(closetimer);
        closetimer = null;}}

  $(document).ready(function()
  {  $('#main_menu > li').bind('mouseover', main_menu_open)
     $('#main_menu > li').bind('mouseout',  main_menu_timer)});

  document.onclick = main_menu_close;

  function highlightMenu( menu )
  {
	  menu.style.background = '#ebebeb';
	  document.body.style.cursor='pointer';
	  return false;
  } 

  function downlightMenu( menu )
  {
	  menu.style.background = '#FFFFFF';
	  document.body.style.cursor='default';
	  return false;
  }
  
</script>

<div class="center main_container">
  	<div id="header" style="float: left; margin-bottom: 30px;">
  		<a href="/"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/logo.png" /></a>
	</div>
	<div style="margin-left: 890px; padding-top: 50px">
    	<a href="http://feeds2.feedburner.com/PhpHatesMe-DerPhpBlog" target="_blank" alt="RSS Feed" title="RSS Feed"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/rss_small.png" /></a>
    	<a href="http://www.twitter.com/phphatesme" target="_blank" alt="Twitter" title="Twitter"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/twitter_small.png" /></a>
    	<a href="http://www.facebook.com/pages/phphatesme/255297423679" target="_blank" alt="Facebook" title="Facebook"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/facebook_small.png" /></a>
	</div>
</div>
<div style="clear:both"></div>

<div style="background-color: #262626; margin-bottom: 00px; height: 45px;">
  <div class="center simple_main_container">
  	<div id="main_menu_div">
  	
  	<ul id="main_menu">
      <li><a href="/"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/menu/startseite.png" /></a></li>    
      <li>
      	<a href="/das-projekt/">
      		<img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/menu/projekt.png" />
      	</a>
      	<div style="clear:both"></div>
      	<div class="main_menue_submenue">
          	<div onclick="location.href='/das-projekt'" class="main_menue_submenue_element" onmouseover="highlightMenu(this)" onmouseout="downlightMenu(this)">
          		<b>Wir &uuml;ber uns</b>	
          		<p>Falls ihr ein wenig mehr &uuml;ber uns wissen wollt, dann seid ihr hier richtig. Sogar ein paar Statistiken k&ouml;nnen wir euch bieten.</p>
          	</div>
          	<div onclick="location.href='/lobhudelei'" class="main_menue_submenue_element" onmouseover="highlightMenu(this)" onmouseout="downlightMenu(this)">	
          		<b>Andere &uuml;ber uns</b>	
          		<p>Falls ihr wissen wollt, was andere &uuml;ber uns denken, dann solltet ihr hier klicken. <i>Ein wenig darf man ja mal angeben.</i></p>
          	</div>        	
      	</div>
      </li>
      <li><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/menu/tools.png" />    	
      	  <div style="clear:both"></div>
          <div class="main_menue_submenue" style="padding: 15px;">
          		<div onclick="location.href='/blog/allgemein/pushwp-neues-wordpress-plugin/'">
          			<div class="imageBox">
          				<a href="/blog/allgemein/pushwp-neues-wordpress-plugin/"><img src="/images/4/menu/submenue_tools/pushWP_logo.gif"/></a>
          			</div>
          			<p><b>pushWP</b> erweitert euren Wordpres-Blog um ein paar Features, die helfen sollen ihn noch bekannter zu machen.</p>
  				</div>		
  				<div onclick="location.href='/block-rules/'">
          			<div class="imageBox">
          				<a href="/block-rules/">
          					<img src="/images/4/menu/submenue_tools/blockrules_logo.gif" />
          				</a>
          			</div>
          			<p>Mit <b>BlockRules</b> sind Wordpress User in der Lage bestimmte Inhaltsbl&ouml;cke unter bestimmten Umst&auml;nden anzuzeigen.</p>
  				</div>
          </div>
      </li>
      <li><a href="/archives/category/interviews/"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/menu/interviews.png" /></a>
          <div style="clear:both"></div>
          <div class="main_menue_submenue" style="padding: 15px;width: 415px">
          	<div class="main_menue_submenue_headline">
          		Unsere neusten Interviews
          	</div>
          	<div id="main_menue_submenue_interviews">
          	                        	                    	                    	                    	                  		
                                              		<a href="http://www.phphatesme.com/blog/interviews/interview-mit-den-veranstalltern-der-php-unconference/" rel="bookmark" title="PHP Unconfernce Team">
                    			<img src="/upload/2010/04/unconf.png" height="82px" style="margin-right: 5px;"/>
                    		</a>
                    	                                      	                    	                    	                    	                  		
                                              		<a href="http://www.phphatesme.com/blog/interviews/interview-mit-johannes-schluter/" rel="bookmark" title="">
                    			<img src="/upload/2009/10/johannes.png" height="82px" style="margin-right: 5px;"/>
                    		</a>
                    	                                      	                    	                    	                    	                  		
                                              		<a href="http://www.phphatesme.com/blog/interviews/interview-mit-sebastian-bauer-vorsitzender-des-landesverbandes-baden-wurttemberg-der-piratenpartei/" rel="bookmark" title="">
                    			<img src="/upload/2009/09/bauer.png" height="82px" style="margin-right: 5px;"/>
                    		</a>
                    	                                      	                    	                    	                    	                  		
                                              		<a href="http://www.phphatesme.com/blog/interviews/interview-mit-stephan-schmidt/" rel="bookmark" title="">
                    			<img src="/upload/2009/08/stephan_schmidt.jpg" height="82px" style="margin-right: 5px;"/>
                    		</a>
                    	                                      	                    	                    	                    	                  		
                                              		<a href="http://www.phphatesme.com/blog/interviews/interview-mit-lars-jankowfsky/" rel="bookmark" title="">
                    			<img src="/upload/2009/06/lars.jpg" height="82px" style="margin-right: 5px;"/>
                    		</a>
                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                                      	                    	                    	                    	                  		
                                              		<a href="http://www.phphatesme.com/blog/interviews/interview-mit-hans-jurgen-schonig/" rel="bookmark" title="">
                    			<img src="/upload/2009/04/hans-juergen-schoenig.jpg" height="82px" style="margin-right: 5px;"/>
                    		</a>
                    	                                      	                    	                    	                    	                  		
                               
               </div>
               <div class="main_menue_submenue_info"><p>Von Zeit zu Zeit haben wir die Ehre ein paar der gro&szlig;en Namen der PHP-Szene zu interviewen. <a href="/archives/category/interviews/"><b>Zur Interview-&Uuml;bersicht</b></a>.</p></div>   	 
          </div>
      </li>
      <li><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/menu/community.png" />
     		<div style="clear:both"></div>
     		<div class="main_menue_submenue" style="width: 310px">
            	<div onclick="location.href='/die-ideenschmiede'" class="main_menue_submenue_element" onmouseover="highlightMenu(this)" onmouseout="downlightMenu(this)">
        		<b>Die Ideenschmiede</b>	
        		<p>Dir fehlt ein Beitrag oder ein Thema interessiert die brennend? Dann ist die Ideenschmiede genau die richtige Anlaufstelle.</p>
        		</div>
            	<div onclick="location.href='/archives/category/phmnetwork/'" class="main_menue_submenue_element" onmouseover="highlightMenu(this)" onmouseout="downlightMenu(this)">
        		<img src="/images/phmnetwork_small.png" style="margin-bottom: 10px; margin-right: 300px"/>
        		<p>Es gibt viele gute Blogs. Wir haben versucht die besten zusammenzustellen.</p>
        		</div>
        	</div>    	
      </div>
      </li>
      <li><a href="/archives/category/vortraege/"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/menu/vortraege.png" /></a>
      <div style="clear:both"></div>
      <div class="main_menue_submenue" style="width: 300px;">
      	<div onclick="location.href='/archives/category/vortraege/'" class="main_menue_submenue_element" onmouseover="highlightMenu(this)" onmouseout="downlightMenu(this)">
        		<b>Vortr&auml;ge</b>	
        		<p>Viele Vortr&auml;ge, die auf Konferenzen gehalten werden, landen irgendwo im Internet. Wir haben sie f&uuml;r euch zusammengesucht.</p>
      	</div>
      </div>
      </li>
    </ul>
  	</div>
  </div>
</div>
  <div class="center simple_main_container" style="padding-bottom: 30px;">
  	<div style="background-color: #262626; width: 300px; height: 30px; padding: 5px; color: white; display:none;" id="search_field">
  		<form method="get" action="http://www.phphatesme.com">
  			Suche <input type="text" style="margin-left: 10px; margin-right: 10px; width: 235px" name="s"/>
  		</form>
  	</div>
 	<img id="search_slider" src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/search_top.png" style="padding-top:0px;" />
  	
  	<script type="text/javascript">
  	$('#search_slider').click(function() {
  	  $('#search_field').slideToggle('', function() {
  	    // Animation complete.
  	  });
  	});
  	</script>
</div>
	<div class="center main_container">
	
		<div class="content_block">
			<div class="double_element left_element" style="height: 280px;">
          		<div class="slider">
                  	<a href="/archives/category/phmnetwork/"><img src="/images/specials/network.jpg" /></a>
                </div>
            </div>
            <div class="right_element" id="home_partner">
            	<p>Wir werden unterst&uuml;tzt von</p>
<script type="text/javascript">

function partner_bwImage( img )
{
	imagePath = '/images/4/partner/';
	img.src = imagePath + img.alt + '_bw.png';
}

function partner_colorImage( img )
{
	imagePath = '/images/4/partner/';
	img.src = imagePath + img.alt + '.png';
}

</script>
<a href="http://www.livewatch.de/" target="_blank"><img src="/images/4/partner/livewatch_bw.png" alt="livewatch" onmouseout="partner_bwImage(this)" onmouseover="partner_colorImage(this)"/></a>
<a href="http://it-republik.de/php/" target="_blank"><img src="/images/4/partner/phpmagazin_bw.png" onmouseout="partner_bwImage(this)" onmouseover="partner_colorImage(this)" alt="phpmagazin" /></a>
<a href="http://www.mayflower.de" target="_blank"><img src="/images/4/partner/mayflower_bw.png" onmouseout="partner_bwImage(this)" onmouseover="partner_colorImage(this)" alt="mayflower" /></a>
<a href="http://www.thephp.cc" target="_blank"><img src="/images/4/partner/thephpcc_bw.png" onmouseout="partner_bwImage(this)" onmouseover="partner_colorImage(this)" alt="thephpcc"/></a>
<a href="http://www.galileocomputing.de" target="_blank"><img src="/images/4/partner/galileo_bw.png" onmouseout="partner_bwImage(this)" onmouseover="partner_colorImage(this)"  alt="galileo"/></a>
<a href="http://entwickler-press.de" target="_blank"><img src="/images/4/partner/entwicklerpress_bw.png" onmouseout="partner_bwImage(this)" onmouseover="partner_colorImage(this)" alt="entwicklerpress" /></a>
<div style="text-align:center"><a href="http://qafoo.com" target="_blank"><img src="/images/4/partner/qafoo_bw.png" onmouseout="partner_bwImage(this)" onmouseover="partner_colorImage(this)" alt="qafoo" /></a></div>
  			</div>
        </div>

        <div class="content_block">
        	<div class="double_element left_element">
          		<div class="single_element left_element">
          	      <div>	
    <i>2. May 2011</i> 
    <h3>
    	<a href="http://www.phphatesme.com/blog/konferenzen/international-php-conference-2011-spring-edition/" rel="bookmark">International PHP Conference 2011 Spring Edition</a>
    </h3>
    <p>
      Wer hat an der Uhr gedreht? ... Ja so könnte ich singen, also wenn ich singen könnte. Was ich aber auch sagen kann ist, dass die nächste PHP-Konferenz ansteht und zwar ganz bald.Ganz bald bedeutet in diesem Fall vom 29. Mai bis zum 1. Juni. Schon vorab, ich werde da sein. Leider nicht mit eigener Session, da die irgendwie im Spamfilter gelandet ist, aber trotzdem glücklicher Teilnehmer, den bis ...    </p>
    <br/>
    <a href="http://www.phphatesme.com/blog/konferenzen/international-php-conference-2011-spring-edition/" rel="bookmark">
    	<img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/weiterlesen_grau.png" />
    </a>
</div>          		</div>
          		<div class="single_element center_element">
          		  <div>	
    <i>29. April 2011</i> 
    <h3>
    	<a href="http://www.phphatesme.com/blog/allgemein/foreach-else/" rel="bookmark">Foreach-Else</a>
    </h3>
    <p>
      Wahrscheinlich habt ihr heute alle frei? Ich meine, William und Kate heiraten ja und da sollte man vorm TV sitzen. Oder auch nicht, ich zumindest habe frei (aber aus anderen Gründen). Nichtsdestotrotz  will ich trotzdem versuchen was zu Papier zu bringen und wie jeden Freitag was veröffentlichen. Zwar nur was kurzes, aber für `nen Nils-hat-Urlaub-Tag ist das ja OK.

Wer von euch kennt Twig? Niemand? ...    </p>
    <br/>
    <a href="http://www.phphatesme.com/blog/allgemein/foreach-else/" rel="bookmark">
    	<img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/weiterlesen_grau.png" />
    </a>
</div>          		</div>
          		<div class="double_element left_element">
            	  <h2>Die Artikel der letzten Woche im &Uuml;berblick</h2>
            	  <ul class="post_list">
            <li>
    	<div style="float: left;">
    	     	     	       	       	     	     	       	 <a href="http://www.phphatesme.com/archives/category/phmnetwork/"><img src="/images/phmnetwork_small.png" style="padding-right: 20px" /></a>
  	           	     	 <a href="http://www.phphatesme.com/blog/php/kleinigkeiten-eine-logdatei/" rel="bookmark">Kleinigkeiten: Eine Logdatei</a>
    	</div>
    	  			<div style="text-align: right; font-size: 9px;">&nbsp;</div>
    	    </li>
                              <li>
    	<div style="float: left;">
    	     	     	       	       	     	       	       	     	     	       	 <a href="http://www.phphatesme.com/archives/category/phmnetwork/"><img src="/images/phmnetwork_small.png" style="padding-right: 20px" /></a>
  	           	     	 <a href="http://www.phphatesme.com/blog/buchtipp/extending-and-embedding-php/" rel="bookmark">Extending and Embedding PHP</a>
    	</div>
    	  			<div style="text-align: right; font-size: 9px;">&nbsp;</div>
    	    </li>
              <li>
    	<div style="float: left;">
    	     	     	       	       	     	       	       	     	     	       	 <a href="http://www.phphatesme.com/archives/category/phmnetwork/"><img src="/images/phmnetwork_small.png" style="padding-right: 20px" /></a>
  	           	     	 <a href="http://www.phphatesme.com/blog/allgemein/jobs-worker-clients-und-der-gearman-teil-2/" rel="bookmark">Jobs, Worker, Clients und der Gearman (Teil 2)</a>
    	</div>
    	  			<div style="text-align: right; font-size: 9px;">&nbsp;</div>
    	    </li>
              <li>
    	<div style="float: left;">
    	     	     	       	       	     	 <a href="http://www.phphatesme.com/blog/php/psr-0-namespaces-richtig-auflosen/" rel="bookmark">PSR-0 &#8211; Namespaces richtig auflösen</a>
    	</div>
    	    		<div style="text-align: right; font-size: 9px;"><a href="http://www.phphatesme.com/blog/php/psr-0-namespaces-richtig-auflosen/#comments" title="Kommentiere PSR-0 &#8211; Namespaces richtig auflösen"><b>8</b> Kommentare</a></div>
  		    </li>
              <li>
    	<div style="float: left;">
    	     	     	     	       	 <a href="http://www.phphatesme.com/archives/category/phmnetwork/"><img src="/images/phmnetwork_small.png" style="padding-right: 20px" /></a>
  	           	     	 <a href="http://www.phphatesme.com/blog/phmnetwork/node-js-%e2%80%93-eine-einfuhrung-http-log-server/" rel="bookmark">node.js – Eine Einführung (HTTP Log Server)</a>
    	</div>
    	  			<div style="text-align: right; font-size: 9px;">&nbsp;</div>
    	    </li>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            </ul>
<div style="clear: both"></div>
            	              	  <a href="/blog/2011/05/"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/artikeluebersicht_blau.png"></a>
        		</div>
        	</div>
        	<div class="right_element single_element left_bordered">
<div style="float: left; padding-right: 20px; padding-bottom: 5px;">
		<script type="text/javascript">
	var flattr_url = 'http://www.phphatesme.com';
</script>
<script src="http://api.flattr.com/button/load.js" type="text/javascript"></script>	
</div>
<div style="padding-bottom: 15px">
<p>
Falls Ihr unseren Blog m&ouml;gt, k&ouml;nnt <br />Ihr uns mit <a href="http://flattr.com">Flattr</a> unterst&uuml;tzen. 
</p>
</div>        		
<h6>Werbung</h6>
        		<div style="height: 160px">
                <a href="http://www.phpmagazin.de" target="_blank"><img src="/images/werbung/phpmag0210.png" class="image_text_left" /></a>
                <div style="padding-bottom: 5px; line-height: 20px;">
                <b>PHP Magazin</b><br />
                Ausgabe 02/2010
                </div>
                <p>
                        Dieses Mal mit Artikeln zu den Themen OpenSocial und Apache Shindig, Graphentheorie, Smarty3
                </p>
</div>
<div style="height: 160px">
<a href="http://www.t3n.de" target="_blank"><img src="/images/werbung/t3n_19.png" class="image_text_left" /></a>
<div style="padding-bottom: 5px; line-height: 20px;">
                <b>t3n</b><br />
                Ausgabe 19
                </div>
                <p>
                        Social Media (R)evolution. Weitere Themen sind noSQL, Crowdsourcing ...
                </p>

</div>
<div style="height: 160px">
<a href="http://www.phpjournal.eu/" target="_blank"><img src="/images/werbung/phpjournal_0210.png" class="image_text_left" /></a>
<div style="padding-bottom: 5px; line-height: 20px;">
                <b>PHP Journal</b><br />
                Ausgabe 2/2010
                </div>
                <p>
                        PHP & Windows optimal nutzen, die besten PHP-CMS im &Uuml;berblick, Google-API mit Zend Framework nutzen.
                </p>
</div>
      		</div>
        </div>
    
        <div class="content_block">
        	<h2>Kategorien</h2>
            <div class="category_list">
	<ul>
      	<li class="cat-item cat-item-40"><a href="http://www.phphatesme.com/archives/category/akademischer-tag/" title="PHP wird in der akademischen Welt häufig belächelt. Wissenschaftliche Themen werden häufig anhand von Java erklärt. Da PHnP in den letzten Jahren erwachsen geworden ist, wollen wir hier ein wenig die Grundlagen erklären, die man in Uni und Ausbildung vielleicht nicht mitgenommen hat oder sie wieder vergessen bzw. verdrängt hat. ">Akademischer Tag</a>
</li>
	<li class="cat-item cat-item-22"><a href="http://www.phphatesme.com/archives/category/aktuelles/" title="Alle unter Aktuelles abgelegten Artikel ansehen">Aktuelles</a>
</li>
	<li class="cat-item cat-item-1"><a href="http://www.phphatesme.com/archives/category/allgemein/" title="Alle unter Allgemein abgelegten Artikel ansehen">Allgemein</a>
</li>
	<li class="cat-item cat-item-36"><a href="http://www.phphatesme.com/archives/category/buchtipp/" title="Alle unter Buchtipp abgelegten Artikel ansehen">Buchtipp</a>
</li>
	<li class="cat-item cat-item-15"><a href="http://www.phphatesme.com/archives/category/mysql/" title="Alle unter Datenbanken abgelegten Artikel ansehen">Datenbanken</a>
</li>
	<li class="cat-item cat-item-38"><a href="http://www.phphatesme.com/archives/category/ein-herz-fur-blogger/" title="In letzter Zeit erblickten immer mehr kleinere deutschsprachige PHP Blogs das Licht der Welt. Viele davon sterben schon wieder nach relativ kurzer Zeit oder es gibt kaum neue Artikel. Finde ich eigentlich mehr als Verständlich, denn bloggen macht erst dann richtig Spaß, wenn man auch Leser hat. Ich hatte damals Glück, dass das PHP Magazin ziemlich schnell einen meiner Artikel verlinkt hat. Zusätzlich hatte ich auch in ein paar Foren Werbung gemacht. Natürlich immer nur thematisch passend (was ein wenig gelogen ist). Naja, auf jeden Fall hatte ich das Glück ziemlich bald eine gute Anzahl von Stammlesern zu begeistern. Zumindest haben sie mich animiert weiter zu machen.

Viele der neu entstandenen Blogs sollten aber auch nicht wieder verschwinden, dazu haben mir die ersten Beiträge einfach zu sehr gefallen und aus diesem Grund werde diese neue Serie gestartet.">Ein Herz für Blogger</a>
</li>
	<li class="cat-item cat-item-37"><a href="http://www.phphatesme.com/archives/category/gewinnspiel/" title="Alle unter Gewinnspiel abgelegten Artikel ansehen">Gewinnspiel</a>
</li>
	<li class="cat-item cat-item-11"><a href="http://www.phphatesme.com/archives/category/interviews/" title="Von Zeit zu Zeit haben wir die Ehre ein paar der großen Namen der PHP Szene zu interviewen. Hier seht ihr eine Übersicht aller Interviews, die wir bereits getätigt haben (unser Team hat sich auch darunter geschlichen). Falls euch jemand einfällt, der fehlt dann meldet euch einfach bei uns. Wir versuchen dann in Kontakt mit den Experten zu treten.">Interviews</a>
</li>
	<li class="cat-item cat-item-9"><a href="http://www.phphatesme.com/archives/category/konferenzen/" title="Alle unter Konferenzen abgelegten Artikel ansehen">Konferenzen</a>
</li>
	<li class="cat-item cat-item-41"><a href="http://www.phphatesme.com/archives/category/lesestoff/" title="Alle unter Lesestoff abgelegten Artikel ansehen">Lesestoff</a>
</li>
	<li class="cat-item cat-item-23"><a href="http://www.phphatesme.com/archives/category/meinphp/" title="Alle unter MeinPHP abgelegten Artikel ansehen">MeinPHP</a>
</li>
	<li class="cat-item cat-item-64"><a href="http://www.phphatesme.com/archives/category/phmnetwork/" title="Das phm|network ist eine Sammlung von deutschsprachigen Blogs rund um das Thema Webentwicklung. Dabei versuchen wir die besten zu finden und zu vernetzen. ">phmnetwork</a>
</li>
	<li class="cat-item cat-item-42"><a href="http://www.phphatesme.com/archives/category/php/" title="Alle unter PHP abgelegten Artikel ansehen">PHP</a>
</li>
	<li class="cat-item cat-item-4"><a href="http://www.phphatesme.com/archives/category/presse/" title="Alle unter Presse abgelegten Artikel ansehen">Presse</a>
</li>
	<li class="cat-item cat-item-24"><a href="http://www.phphatesme.com/archives/category/projektmanagement/" title="Alle unter Projektmanagement abgelegten Artikel ansehen">Projektmanagement</a>
</li>
	<li class="cat-item cat-item-16"><a href="http://www.phphatesme.com/archives/category/projektwerk/" title="Alle unter Projektwerkstatt abgelegten Artikel ansehen">Projektwerkstatt</a>
</li>
	<li class="cat-item cat-item-21"><a href="http://www.phphatesme.com/archives/category/qualitatssicherung/" title="Alle unter Qualitätssicherung abgelegten Artikel ansehen">Qualitätssicherung</a>
</li>
	<li class="cat-item cat-item-8"><a href="http://www.phphatesme.com/archives/category/schwarzer-magier/" title="Alle unter Schwarzer Magier abgelegten Artikel ansehen">Schwarzer Magier</a>
</li>
	<li class="cat-item cat-item-20"><a href="http://www.phphatesme.com/archives/category/sicherheit/" title="Alle unter Sicherheit abgelegten Artikel ansehen">Sicherheit</a>
</li>
	<li class="cat-item cat-item-5"><a href="http://www.phphatesme.com/archives/category/softwaretechnik/" title="Alle unter Softwaretechnik abgelegten Artikel ansehen">Softwaretechnik</a>
</li>
	<li class="cat-item cat-item-39"><a href="http://www.phphatesme.com/archives/category/stellenanzeige/" title="Alle unter Stellenanzeige abgelegten Artikel ansehen">Stellenanzeige</a>
</li>
	<li class="cat-item cat-item-12"><a href="http://www.phphatesme.com/archives/category/termine/" title="Alle unter Termine abgelegten Artikel ansehen">Termine</a>
</li>
	<li class="cat-item cat-item-7"><a href="http://www.phphatesme.com/archives/category/tools/" title="Alle unter Tools &amp; Helferlein abgelegten Artikel ansehen">Tools &amp; Helferlein</a>
</li>
	<li class="cat-item cat-item-54"><a href="http://www.phphatesme.com/archives/category/vortraege/" title="Alle unter Vorträge abgelegten Artikel ansehen">Vorträge</a>
</li>
	<li class="cat-item cat-item-6"><a href="http://www.phphatesme.com/archives/category/webentwicklung/" title="Alle unter Webentwicklung abgelegten Artikel ansehen">Webentwicklung</a>
</li>
	<li class="cat-item cat-item-3"><a href="http://www.phphatesme.com/archives/category/wtf/" title="Alle unter What the f***! abgelegten Artikel ansehen">What the f***!</a>
</li>
  	</ul>
</div>

        </div>
    
        <div class="content_block">
        	<h2>Vortr&auml;ge</h2>
        		<div class="double_element left_element">
        		   <style>
#demotip {
	display:none;
	background:transparent url(/images/tools/black_arrow.png);
	font-size:9px;
	height:50px;
	width:90px;
	color:#fff;	
	line-height: 18px;
	padding-bottom: 10px;
	padding-top: 15px;
	padding-left: 5px;
	padding-right: 5px;
}

/* style the trigger elements */
#demo img {

}
</style>

<script src="/extensions/jquery.tools.min.js"></script>

	<div id="demotip">&nbsp;</div> 
	<div id="demo">	
	<ul>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/webentwicklung/pycon-2011-scaling-disqus/">
				<img title="PyCon 2011 Scaling Disqus" style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/pycon2011scalingdisqus-110313134549-phpapp01-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/tools/redis-memory-as-the-new-disk/">
				<img title="Redis -- Memory as the New Disk ..." style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/redisnosqleu-100421101910-phpapp01-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/softwaretechnik/git-vs-svn-eine-vergleichende-einfuhrung/">
				<img title="Git vs SVN - Eine vergleichende ..." style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/gitphpug-100603140849-phpapp01-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/projektwerk/it-risikomanagement/">
				<img title="IT Risikomanagement" style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/itrisikomanagementbvh-110325040127-phpapp01-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/softwaretechnik/declarative-development-using-annotations-in-php/">
				<img title="Declarative Development Using Annotations ..." style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/declarative-development-using-annotations-in-php-19080-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/tools/do-you-queue/">
				<img title="Do you queue" style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/doyouqueue-101110081530-phpapp02-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/softwaretechnik/der-erfolgreiche-programmierer/">
				<img title="Der Erfolgreiche Programmierer" style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/schmidt-stephan-der-erfolgreiche-programmierer-animation-101109130454-phpapp01-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/webentwicklung/using-font-face-to-unleash-web-typography/">
				<img title="Using @font-face to unleash web ..." style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/font-face-kuwebdev-sept2010-100928173039-phpapp01-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/qualitatssicherung/unit-testing-symfony-plugins-with-php-unit/">
				<img title="Unit testing symfony plugins with ..." style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/unittestingsymfonypluginswithphpunit-101009132914-phpapp01-thumbnail-2" />
			</a>			
		</li>
		<li style="float: left; list-style: none;">
  			<a href="http://www.phphatesme.com/blog/softwaretechnik/live-on-stage/">
				<img title="Live On Stage" style="border: 1px solid #dddbd3;width: 97px; height: 73px;margin-bottom: 24px; margin-right: 24px;" src="http://cdn.slidesharecdn.com/liveonstage-100514100900-phpapp01-thumbnail-2" />
			</a>			
		</li>
	</ul>
	</div>
	<script type="text/javascript">
$(document).ready(function() { 
    $("#demo img[title]").tooltip({ 
    	 
        // place tooltip on the right edge 
        position: "bottom center", 
     
        // use this single tooltip element 
        tip: '#demotip' 
     
    }); 
});
</script>            	</div>
            	<div class="single_element right_element" id="home_presentation_info">
            		<p>
            			phphatesme versucht eine aktuelle Sammlung der interessantesten Pr&auml;sentatioen zusammen zu stellen.
          			</p>	
          			<a href="/archives/category/vortraege/"><img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/vortragsuebersicht_blau.png"></a>            		 
            	</div>
        </div>
    
        <div class="content_block">
        	<h2>Empfehlungen</h2>
            	<div class="single_element left_element">
            		<h3>Beliebteste Artikel diesen Monat</h3>
            		<p>Nat&uuml;rlich war bei uns im letzen Monat viel Los. Damit ihr nichts aktuelles verpasst, hier noch mal 
            		eine Liste der beliebtensten Artikel der letzten 30 Tage.</p>
            	</div>
        		<div class="double_element center_element statictic">
        			<ul>
<li style="padding-bottom: 5px; list-style: none; color: white; font-weight: bold;">
	<div style="padding: 5px; padding-right: 0px; background-color: #0394cb;width:655px">
	  	<a style="color: white" href="http://www.phphatesme.com/blog/allgemein/der-erste-post/">Der erste Post</a>
	</div>  
</li>
<li style="padding-bottom: 5px; list-style: none; color: white; font-weight: bold;">
	<div style="padding: 5px; padding-right: 0px; background-color: #25a6d7;width:650px">
	  	<a style="color: white" href="http://www.phphatesme.com/blog/softwaretechnik/git-vs-svn-eine-vergleichende-einfuhrung/">Git vs SVN - Eine vergleichende Einführung</a>
	</div>  
</li>
<li style="padding-bottom: 5px; list-style: none; color: white; font-weight: bold;">
	<div style="padding: 5px; padding-right: 0px; background-color: #44b3dd;width:506px">
	  	<a style="color: white" href="http://www.phphatesme.com/blog/tools/redis-memory-as-the-new-disk/">Redis -- Memory as the New Disk</a>
	</div>  
</li>
<li style="padding-bottom: 5px; list-style: none; color: white; font-weight: bold;">
	<div style="padding: 5px; padding-right: 0px; background-color: #6cbfde;width:462px">
	  	<a style="color: white" href="http://www.phphatesme.com/blog/projektwerk/it-risikomanagement/">IT Risikomanagement</a>
	</div>  
</li>
<li style="padding-bottom: 5px; list-style: none; color: white; font-weight: bold;">
	<div style="padding: 5px; padding-right: 0px; background-color: #89cbe3;width:459px">
	  	<a style="color: white" href="http://www.phphatesme.com/blog/webentwicklung/die-ultimative-lernprogramm/">Das ultimative "Lernprogramm"</a>
	</div>  
</li>
</ul>            	</div>
        </div>        
    
        <div class="content_block">
        	<h2>Sonstiges</h2>
        	<br/>
        	<div class="single_element left_element">
        		<h3>Akademischer Tag</h3>
        		<img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/akademisch_klein.png" class="image_text_left" style="padding-top: 8px;" />
        		<p>Der <a href="/archives/category/akademischer-tag/"><b>akadmische Tag</b></a> versucht die Theorie ein wenig n&auml;her zu bringen, ohne dabei langweilig zu sein</p>
        		<h4>Die neusten Beitr&auml;ge</h4>
        		<div class="home_sonstiges_liste">
        		<ul>
	        	<li>
        		<a href="http://www.phphatesme.com/blog/webentwicklung/understanding-advanced-regular-expressions/">
          	  Understanding advanced regular expressions        		</a>
        	</li>
                	<li>
        		<a href="http://www.phphatesme.com/blog/softwaretechnik/wer-braucht-variablen-die-funktionale-welt/">
          	  Wer braucht Variablen? Die funktionale Welt...        		</a>
        	</li>
                	<li>
        		<a href="http://www.phphatesme.com/blog/webentwicklung/regulare-ausdrucke-pcre/">
          	  Reguläre Ausdrucke (PCRE)        		</a>
        	</li>
        </ul>        		</div>
        	</div>
        	<div class="single_element center_element left_bordered" style="height: 250px">
        		<h3>Buchtipps</h3>
        		<a href="http://www.amazon.de/gp/product/3826655486?ie=UTF8&ref_=sr_1_2&s=books&qid=1265471345&sr=8-2&linkCode=shr&camp=3206&creative=21426&tag=phhamebuthsok-21">
					<img src="/images/buchtipp/cleancode.png" class="image_text_left" />
				</a>
        		<p>
        		<a href="http://www.phphatesme.com/blog/buchtipp/buchtipp-clean-code/">
        			<b>Clean Code</b>
        		</a> von Robert C. Martin ist eine Pflichtlekt&uuml;re f&uuml;r alle, die sauber Programmieren wollen.
        		</p>
        		<a href="http://www.amazon.de/gp/product/3826655486?ie=UTF8&ref_=sr_1_2&s=books&qid=1265471345&sr=8-2&linkCode=shr&camp=3206&creative=21426&tag=phhamebuthsok-21">     		
        			<img src="/images/amazon_small.png" />
      			</a>
        	</div>
        	<div class="single_element right_element left_bordered" style="height: 250px">
        		<h3>Die Ideenschmiede</h3>
        		<p>Da unsere Leser nicht faul sind, ist die <a href="/die-ideenschmiede"><b>Ideen&shy;schmiede</b></a> immer gut gef&uuml;llt.</p>
        		<h4>Die neusten Vorschl&auml;ge</h4>
        		<div class="home_sonstiges_liste">
            		<style type="text/css" media="screen">
						@import url( http://www.phphatesme.com/wp-content/themes/phphatesme4_1/css/ideenschmiede.css );
					</style>
            		<script type="text/javascript">
<!--
	function submitVoting( id ) 
	{
		id_field = document.getElementById( 'ideaid' );
		id_field.value = id;
		document.vote.submit( );
		return false;
	}

	function votingShowIdeas( )
	{
		showOpen   = document.getElementById( 'cb_open' ).checked;
		showClosed = document.getElementById( 'cb_closed' ).checked;
	
		if( showClosed ) {
			$(".page_ideenschmiede_done").css("display","block");			
		}else{
			$(".page_ideenschmiede_done").css("display","none");
		}

		if( showOpen ) {
			$(".page_ideenschmiede_open").css("display","block");			
		}else{
			$(".page_ideenschmiede_open").css("display","none");				
		}
	} 
//-->
</script>

            		
            		<form action="/die-ideenschmiede" method="post" name="vote">
            		<input type="hidden" name="idea_id" id="ideaid" />
            		            		<div class="page_ideenschmiede_plus" style="padding-top: 3px; padding-bottom: 3px">
                		<a href="#" onclick="submitVoting(322)">+</a>
                	</div>
            		<div class="page_ideenschmiede_votingcount" style="padding-top: 3px; padding-bottom: 3px">17</div>
                		<div style="margin-left: 70px; padding-bottom: 15px; padding-top: 3px; padding-bottom: 3px">
                			PHP und SSL; Zertifikate erstellen (mit CA-Cert), ...                		</div>
                		<br />
            		            		<div class="page_ideenschmiede_plus" style="padding-top: 3px; padding-bottom: 3px">
                		<a href="#" onclick="submitVoting(321)">+</a>
                	</div>
            		<div class="page_ideenschmiede_votingcount" style="padding-top: 3px; padding-bottom: 3px">4</div>
                		<div style="margin-left: 70px; padding-bottom: 15px; padding-top: 3px; padding-bottom: 3px">
                			Zeta components                		</div>
                		<br />
            		            		<div class="page_ideenschmiede_plus" style="padding-top: 3px; padding-bottom: 3px">
                		<a href="#" onclick="submitVoting(320)">+</a>
                	</div>
            		<div class="page_ideenschmiede_votingcount" style="padding-top: 3px; padding-bottom: 3px">6</div>
                		<div style="margin-left: 70px; padding-bottom: 15px; padding-top: 3px; padding-bottom: 3px">
                			PHP ist keine Programmiersprache, eine (un)dogmatische ...                		</div>
                		<br />
            		            		<div class="page_ideenschmiede_plus" style="padding-top: 3px; padding-bottom: 3px">
                		<a href="#" onclick="submitVoting(319)">+</a>
                	</div>
            		<div class="page_ideenschmiede_votingcount" style="padding-top: 3px; padding-bottom: 3px">14</div>
                		<div style="margin-left: 70px; padding-bottom: 15px; padding-top: 3px; padding-bottom: 3px">
                			Injection                		</div>
                		<br />
            		            		</form>
        		</div>
        	</div>
        </div>
	</div>
	<style type="text/css">
<!--

#thx_field {
	background-color: #DDDBD3; 
	width: 610px;  
	padding-bottom: 10px; 
	padding-left: 10px; 
	padding-right: 10px; 
	color: #5a5757;
	display: none;
}

#thx_field img {
	padding-left: 20px; 
	padding-top: 20px; 
	padding-right: 20px; 
	padding-bottom: 20px;
}

-->
</style>


<div style="clear:both"></div>
  <div class="center simple_main_container" style="padding-top: 20px;">
    <div id="thx_slider">
      <a href="javascript:"><img src="/images/4/thx.png" /></a>
    </div>
  </div>
  <div class="center simple_main_container" style="padding-bottom: 0px;">
    <div style="" id="thx_field">
      <div style="padding-top: 10px; line-height: 18px"> 
        <a target="_blank" href="http://www.amazon.de/gp/redirect.html?ie=UTF8&location=http%3A%2F%2Fwww.amazon.de%2F&site-redirect=de&tag=phhamebuthsok-21&linkCode=ur2&camp=1638&creative=19454">
        	<img src="/images/4/amazon.png" align="right" />
        </a>
        Wir wurden schon &ouml;fters gefragt, ob man uns nicht irgendwie unterst&uuml;tzen kann. Die Antwort war immer einfach:
        <b>Klar!</b> Am einfachsten ist es eure n&auml;chsten Eink&auml;ufe bei Amazon &uuml;ber unsere Link abzuwickeln. Damit 
        w&uuml;rdet ihr uns schon sehr helfen. &Uuml;ber Co-Autoren freuen wir uns aber noch mehr.
      </div>
    </div>
    <script type="text/javascript">
      $('#thx_slider').click(function() {
        $('#thx_field').slideToggle('');
      });
    </script>
  </div>
<div id="footer">
  <div class="center simple_main_container" style="padding-top: 20px;">
	<div class="left_element simple_element" style="width: 250px; padding-top: 18px; height: 140px">
		<img src="http://www.phphatesme.com/wp-content/themes/phphatesme4_1/images/logo_footer.png" />
	</div>
	<div class="simple_element" style="float: left">
	<h3>Inhalt</h3>
	    <ul style="line-height: 22px;">
		<li><a href="/impressum">Impressum</a></li>
        <li><a href="/presse">Presse</a></li>
		<li><a href="/blog/2011/05/">Artikel&uuml;bersicht</a></li>
	    </ul>    
    </div>
	<div class="simple_element" style="margin-left: 80px; float: left; width: 200px">
		<h3>Soziale Netze</h3>
            <ul style="line-height: 22px;">                
		<li><a href="http://feeds2.feedburner.com/PhpHatesMe-DerPhpBlog" target="_blank">RSS Feed</a></li>
		<li><a href="http://feeds.feedburner.com/phphatesme/noNetwork" target="_blank">RSS Feed ohne phm|network</a></li>
		<li><a href="http://www.facebook.com/pages/phphatesme/255297423679" target="_blank">Facebook</a></li>
		<li><a href="http://www.twitter.com/phphatesme" target="_blank">Twitter</a></li>
		<li><a href="http://www.livewatch.de"><i>Server&uuml;berwachung</i></a></li>
         </ul>
	</div>
	<div class="simple_element" style="margin-left: 80px; float: left; width: 290px">
		<h3>Co-Autor werden</h3>
          <p style="color: white">Falls du Ahnung von PHP hast, dann mache es wie einige vor dir und melde dich bei uns (autor@phphatesme) als Co-Autor.</p>
          
	</div>
  </div>
</div></body>
</html>

<!-- Dynamic page generated in 2.887 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2011-05-03 19:25:24 -->
