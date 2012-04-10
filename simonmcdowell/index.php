<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta charset="UTF-8">
<?php include 'pagelayout/head-tag.php'; ?>
<title>Drummer / Drum Tutor [ Simon McDowell ]</title>
</head>
<body>
<?php include 'pagelayout/header.php'; ?>

<div class="contents">
<?php include 'pagelayout/left-image.php'; ?>
<div class="right-panel">
<?php 

$___conf=unserialize(file_get_contents("./simon.conf"));
$r=$_SERVER['REQUEST_URI'];
if($p=strpos($r,"?")) $r=substr($r,0,$p);
if($r==="/") $r="index.php";
$f=getcwd()."/pageinner".$r;
if(!file_exists($f))
	$f=getcwd()."/pageinner/index.php";
include $f;
?>
</div>
<div class="clear"></div>
</div>

</div>
<br class="clear" />
</div>

<?php include 'pagelayout/footer.php'; ?>

</body>
</html>
