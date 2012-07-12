<?php
session_start();
set_include_path('./');
$r=$_SERVER['REQUEST_URI'];
if(!strstr($r,"/tuition.php?mode=confirm")){
	echo <<<EOB
<!DOCTYPE html>
<html>
<head>
EOB;
	include 'pagelayout/head-tag.php';
	echo <<<EOB
<title>Drummer / Drum Tutor [ Simon McDowell ]</title>
</head>
<body>
EOB;
	include 'pagelayout/header.php'; 
	echo <<<EOB
<div class="contents">
EOB;
	include 'pagelayout/left-image.php';
	echo <<<EOB
<div class="right-panel">
EOB;
}
$___conf=unserialize(file_get_contents("./simon.conf"));

if($p=strpos($r,"?")) $r=substr($r,0,$p);
if($r==="/") $r="index.php";
$f=getcwd()."/pageinner".$r;
if(!file_exists($f))
	$f=getcwd()."/pageinner/index.php";
include $f;

if(!strstr($r,"/tuition.php?mode=confirm")){
	echo <<<EOB
</div>
<div class="clear"></div>
</div>

</div>
<br class="clear" />
</div>

EOB;
include 'pagelayout/footer.php';

	echo <<<EOB
</body>
</html>
EOB;
}
