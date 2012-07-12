<h2>Gallery</h2>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.galleriffic.js"></script>
<script type="text/javascript" src="js/jquery.opacityrollover.js"></script>
<script type="text/javascript">
function gallery(ii){
	
	$imgs=ii;
	var s="";
	for(var i=0; i<$imgs.length; i++){
		s+='<li>';
		s+='	<a class="thumb" name="leaf" href="'+$imgs[i][0]+'" title="">';
		s+='		<img src="'+$imgs[i][1]+'" alt="" />';
		s+='	</a>';
		s+='</li>';
	}

	$("#thumbs ul.thumbs").append(s);
	$('div.navigation').css({'width' : 'auto', 'float' : 'left'});
	$('div.content').css('display', 'block');
 
	var onMouseOutOpacity = 0.67;
	$('#thumbs ul.thumbs li').opacityrollover({
		mouseOutOpacity:   onMouseOutOpacity,
		mouseOverOpacity:  1.0,
		fadeSpeed:		 'fast',
		exemptionSelector: '.selected'
	});

	var gallery = $('#thumbs').galleriffic({
		delay:					 2500,
		numThumbs:				 15,
		preloadAhead:			  10,
		enableTopPager:			true,
		enableBottomPager:		 true,
		maxPagesToShow:			7,
		imageContainerSel:		 '#slideshow',
		controlsContainerSel:	  '#controls',
		captionContainerSel:	   '#caption',
		loadingContainerSel:	   '#loading',
		renderSSControls:		  true,
		renderNavControls:		 true,
		playLinkText:			  'Play Slideshow',
		pauseLinkText:			 'Pause Slideshow',
		prevLinkText:			  '&lsaquo; Previous Photo',
		nextLinkText:			  'Next Photo &rsaquo;',
		nextPageLinkText:		  'Next &rsaquo;',
		prevPageLinkText:		  '&lsaquo; Prev',
		enableHistory:			 false,
		autoStart:				 false,
		syncTransitions:		   true,
		defaultTransitionDuration: 900,
		onSlideChange:			 function(prevIndex, nextIndex) {
			this.find('ul.thumbs').children()
				.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
				.eq(nextIndex).fadeTo('fast', 1.0);
		},
		onPageTransitionOut:	   function(callback) {
			this.fadeTo('fast', 0.0, callback);
		},
		onPageTransitionIn:		function() {
			this.fadeTo('fast', 1.0);
		}
	});
};
</script>

<style type="text/css">
	div#page {
		width: auto;
		background-color: transparent;
		margin: 0 auto;
		text-align: left;
		border: none;
	}
	div#container {
		padding: 20px;
	}
	div.content {
		display: none;
		margin: auto;
		width: 520px;
	}
	div.content a, div.navigation a {
		text-decoration: none;
		color: #777;
	}
	div.content a:focus, div.content a:hover, div.content a:active {
		text-decoration: underline;
	}
	div.controls {
		margin-top: 5px;
		height: 23px;
	}
	div.controls a {
		padding: 5px;
	}
	div.ss-controls {
		float: left;
	}
	div.nav-controls {
		float: right;
	}
	div.slideshow-container {
		position: relative;
		clear: both;
		height: 520px;
	}
	div.loader {
		position: absolute;
		top: 0;
		left: 0;
		background-image: url('loader.gif');
		background-repeat: no-repeat;
		background-position: center;
		width: 520px;
		height: 520px;
	}
	div.slideshow {

	}
	div.slideshow span.image-wrapper {
		display: block;
		position: absolute;
		top: 0;
		left: 0;
	}
	div.slideshow a.advance-link {
		display: block;
		width: 520px;
		height: 520px;
		line-height: 520px;
		text-align: center;
	}
	div.slideshow a.advance-link:hover, div.slideshow a.advance-link:active, div.slideshow a.advance-link:visited {
		text-decoration: none;
	}
	div.slideshow img {
		vertical-align: middle;
		border: none;
	}
	div.download {
		float: right;
	}
	div.caption-container {
		position: relative;
		clear: left;
		height: 75px;
	}
	span.image-caption {
		display: block;
		position: absolute;
		width: auto;
		top: 0;
		left: 0;
	}
	div.caption {
		padding: 12px;
			}
	div.navigation {
	}
	ul.thumbs {
		clear: both;
		margin: 0;
		padding: 0;
	}
	ul.thumbs li {
		float: left;
		padding: 0;
		margin: 5px 10px 5px 0;
		list-style: none;
	}
	a.thumb {
		padding: 2px;
		width:75px; height:75px;
		display: block;
		border: none;
	}
	ul.thumbs li.selected a.thumb {
		background: #000;
	}
	a.thumb:focus {
		outline: none;
	}
	ul.thumbs img {
		border: none;
		display: block;
	}
	div.pagination {
		clear: both;
	}
	div.navigation div.top {
		margin-bottom: 12px;
		height: 11px;
	}
	div.navigation div.bottom {
		margin-top: 12px;
	}
	div.pagination a, div.pagination span.current, div.pagination span.ellipsis {
		display: block;
		float: left;
		margin-right: 2px;
		padding: 4px 7px 2px 7px;
		border: none;
	}
	div.pagination a:hover {
		background-color: #eee;
		text-decoration: none;
	}
	div.pagination span.current {
		font-weight: bold;
		background-color: #000;
		color: transparent;
	}
	div.pagination span.ellipsis {
		border: none;
		padding: 5px 0 3px 2px;
	}
</style>

<div id="wrap">
  <div id="page">
    <div id="container">
      <div id="gallery2" class="content">
        <div id="controls" class="controls"></div>
        <div class="slideshow-container">
          <div id="loading" class="loader"></div>
          <div id="slideshow" class="slideshow"></div>
        </div>
      </div>
      <div id="thumbs" class="navigation">
        <ul class="thumbs noscript"></ul>
      </div>
      <div style="clear: both;"></div>
    </div>
  </div>
</div>

<?php
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');

$gp = new Zend_Gdata_Photos();

try {
	$query = $gp->newAlbumQuery();
	$query->setUser("110129975935177747102");
	$query->setAlbumName("PhotoshootInNewZealand24122011");
	$query->setThumbsize("512,72");
	$albumFeed = $gp->getAlbumFeed($query);


	$imgs='[';
	foreach ($albumFeed as $albumEntry) {
		$imgs.='["'.$albumEntry->mediaGroup->thumbnail[0]->url.'",';
		$imgs.='"'.$albumEntry->mediaGroup->thumbnail[1]->url.'",';
		$w=$albumEntry->gphotoWidth->text;
		$imgs.='"'.(int)((512-$w)/2).'"],';
	}
	$imgs[strlen($imgs)-1]="]";
	
	echo '<script type="text/javascript">';
	echo '$(document).ready(function(){';
	echo 'var imgs='.$imgs.';';
	echo 'gallery(imgs);';
	echo '});';
	echo '</script>';
}
catch (Zend_Gdata_App_HttpException $e) {
	echo "Error: " . $e->getMessage() . "<br />\n";
	if ($e->getResponse() != null) {
		echo "Body: <br />\n" . $e->getResponse()->getBody() . "<br />\n"; 
	}
}
catch (Zend_Gdata_App_Exception $e) {
	echo "Error: " . $e->getMessage() . "<br />\n"; 
}

?>
