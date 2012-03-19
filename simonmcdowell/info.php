<div class="wrap">
<h2>My YouTube</h2>

<ul id="mymovies">
<?php
error_log("------start----------");
set_include_path('./library/');
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
$yt = new Zend_Gdata_YouTube();
$yt->setMajorProtocolVersion(2);
printVideoFeed($yt->getuserUploads("themoaspecial"));
error_log("------done----------");
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

  $title = $videoEntry->getVideoTitle();//動画のタイトル
  $videoid = $videoEntry->getVideoID();//動画のID
  $description = $videoEntry->getVideoDescription();//動画の説明文
  $tags = $videoEntry->getVideoTags();
  if(is_array($tags)){$tags = implode(',',$tags);}//動画のタグ
  $l_url = $videoEntry->getVideoWatchPageUrl();//動画のURL
  $s_url = 'http://youtu.be/' .  $videoid;//動画の短縮URL
  $time = gmdate('i:s', $videoEntry->getVideoDuration());//動画の長さ
  $count = $videoEntry->getVideoViewCount();//動画の視聴数
  $ratinginfo = $videoEntry->getVideoRatingInfo();
  $rating = $ratinginfo['numRaters'];//動画の評価
  $thumbnail = 'http://i.ytimg.com/vi/' . $videoid . '/hqdefault.jpg';//動画のサムネイル

$yttable = 
'<a class="thickbox" title="プレビュー" href="http://www.youtube.com/watch_popup?v=' . $videoid . '&TB_iframe=true&height=300&width=400">'.
'<img src="' . $thumbnail . '" alt="" width="200" /></a>' .
'<table class="movielines">' .
'<tbody>' .
'<tr><th colspan="2"><a title="'.$description.'" href="'.$l_url.'">' . $title . '</a></th></tr>' .
'<tr><td width="50px">ID:</td><td width="150px"><input class="inputtext" type="text" value="' . $videoid . '" /></td></tr>' .
'<tr><td width="50px">URL:</td><td width="150px"><input class="inputtext" type="text" value="' . $s_url . '" /></td></tr>' .
'<tr><td>tag:</td><td><input class="inputtext" type="text" value="' . $tags . '" /></td></tr>' .
'<tr><td>time:</td><td>' . $time . '</td></tr>' .
'<tr><td>count:</td><td>' . $count . '</td></tr>' .
'<tr><td class="last">rate:</td><td class="last">' . $rating . '</td></tr>' .
'</tbody>' .
'</table>';

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