<div class="wrap">
<h2>Video</h2>

<ul id="mymovies">
<?php
set_include_path('./library/');
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
$yt = new Zend_Gdata_YouTube();
$yt->setMajorProtocolVersion(2);
printVideoFeed($yt->getuserUploads("themoaspecial"));
?>
</ul>
<p id="clear">&nbsp;</p>
</div>

<?php
function printVideoFeed($videoFeed, $displayTitle = null) 
{
  if ($displayTitle === null) {
    $displayTitle = $videoFeed->title->text;
  }
  echo '<h3>' . $displayTitle . '</h3>' . "\n";
  echo "\n";
  foreach ($videoFeed as $videoEntry) {
     echo '<li>';
     printVideoEntry($videoEntry);
     echo "\n";
     echo "</li>";
  }
}
function printVideoEntry($videoEntry) {

  $title = $videoEntry->getVideoTitle();
  $videoid = $videoEntry->getVideoID();
  $description = $videoEntry->getVideoDescription();
  //$tags = $videoEntry->getVideoTags();
  //if(is_array($tags)){$tags = implode(',',$tags);}
  $l_url = $videoEntry->getVideoWatchPageUrl();
  //$s_url = 'http://youtu.be/' .  $videoid;
  //$time = gmdate('i:s', $videoEntry->getVideoDuration());
  //$count = $videoEntry->getVideoViewCount();
  //$ratinginfo = $videoEntry->getVideoRatingInfo();
  //$rating = $ratinginfo['numRaters'];
  $thumbnail = 'http://i.ytimg.com/vi/' . $videoid . '/hqdefault.jpg';

$yttable = 
	'<a class="thickbox" title="preview" href="http://www.youtube.com/watch_popup?v='.$videoid. 
	'&TB_iframe=true&height=300&width=400"><img src="'.$thumbnail.'" alt="" width="200" /></a>'.
	'<table class="movielines"><tbody><tr><th colspan="2"><a title="'.$description.'" href="'.$l_url.'">'.
   	$title.'</a></th></tr></tbody></table>';

echo $yttable;
}?>

<style type="text/css" media="screen">
ul#mymovies{
margin:0;
padding:0;
width:100%;
}
ul#mymovies li{
display:block;
margin:0;
width:200px;
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
