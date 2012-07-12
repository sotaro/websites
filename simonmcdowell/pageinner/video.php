<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" />
<script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto();
	});
</script>

<div class="wrap">
<h2>Video</h2>

<?php
$max = 6;
if(array_key_exists('page',$_GET)) $page = (int)$_GET['page'];
else $page = 1;

//set_include_path('./library/');
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
$yt = new Zend_Gdata_YouTube();
$yt->setMajorProtocolVersion(2);
$query = $yt->newVideoQuery();
$query->setAuthor('themoaspecial');
$query->setOrderBy('updated');
$query->setStartIndex(($page-1)*6+1);
$query->setMaxResults(6);
$videos=$yt->getVideoFeed($query->getQueryUrl(2));
$p=$n=0;
try {
	$p=$videos->getPreviousFeed();
}
catch (Zend_Gdata_App_Exception $e){ }
try {
	$n=$videos->getNextFeed();
}
catch (Zend_Gdata_App_Exception $e){ }
if($p) $prev = "<a href=\"video.php?page=".($page - 1)."\">&lt;&nbsp;Prev&nbsp;".$max."</a>";
else $prev = "&lt;&nbsp;Prev&nbsp;".$max;
if($n) $next = "<a href=\"video.php?page=".($page + 1)."\">Next&nbsp;".$max."&nbsp;&gt;</a>";
else $next = "Next&nbsp;".$max."&nbsp;&gt;";

echo $prev." / ".$next;
echo '<ul id="mymovies">';
printYoutube($videos);
echo '</ul><div class=clear>';
echo $prev." / ".$next;
echo '<p id="clear">&nbsp;</p>';
echo '</div><br class="clear">';

function printYoutube($videos){
	foreach ($videos as $video) {
		$title = $video->getVideoTitle();
		$videoid = $video->getVideoID();
		$description = $video->getVideoDescription();
		$l_url = $video->getVideoWatchPageUrl();
		$path= 'http://www.youtube.com/watch_popup?v='.$videoid;
		$thumbnail = 'http://i.ytimg.com/vi/' . $videoid . '/hqdefault.jpg';
		echo '<li>';
		echo '<a rel="prettyPhoto" href="'.$path.'"><img src="'.$thumbnail.'" width="250" /></a>'.
			'<a style="height:38px; overflow:hidden; display:block" title="'.$description.
			'" href="'.$l_url.'">'.$title.'</a>';
		echo '</li>';
	}
}

?>

<style type="text/css" media="screen">
ul#mymovies{
margin:auto;
padding:0;
width:600px;
}
ul#mymovies li{
display:block;
margin:0;
width:250px;
padding:10px;
float:left;
}
p#clear{
clear:left!important;
font-size:1px;
height:1px;
line-height:1px;
margin:0;
padding:0;
}
table.movielines{
table-layout:fixed;
border:none;
margin:0;
padding:0;
text-align:left;
}
table.movielines tr th{
height:40px;
}
table.movielines tr td{
height:25px;
border-top:1px dotted #888;
}
table.movielines tr td.last{
border-bottom:1px dotted #888;
}
table.movielines tr td input.videoid{
width:99%;
border:none;
background:transparent;
}
</style>
