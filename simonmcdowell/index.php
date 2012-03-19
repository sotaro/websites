<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php 
	header("Content-Type: text/html;charset=EUC-JP");
	include 'pagelayout/head-tag.php'; ?>
<title>Drummer / Drum Tutor [ Simon McDowell ]</title>
</head>
<body>

<?php include 'pagelayout/header.php'; ?>

<div class="contents">
<?php include 'pagelayout/left-image.php'; ?>
<div class="right-panel">
<?php 
	$url = $_SERVER['REQUEST_URI'];
	$nurl = explode("?", $url );
	$path = explode("/", $nurl[0] );
	$fname = $path[count($path)-1];
	switch($fname){
		case "":
		case "index.php":
			include 'pageinner/homecontents.php'; 
		break;
		case "news.php":
			include 'pageinner/newscontents.php'; 
		break;
		case "bio.php":
			include 'pageinner/biocontents.php'; 
		break;
		case "shows.php":
			include 'pageinner/showscontents.php'; 
		break;
		case "gallery.php":
			include 'pageinner/gallerycontents.php'; 
		break;
		case "video.php":
			echo "Coming soon!";
		break;
		case "tuition.php":
			include 'pageinner/tuitioncontents.php';
		break;
		case "tuition_confirm.php":
			include 'pageinner/tuition_confirmcontents.php';
		break;
		case "tuition_thanks.php":
			echo 	"<h2>Drum Tuition</h2>
					<p>Thank you for your inquiry. Your message has been sent successfully.</p>
					<p>Simon will reply to you shortly.</p>";
		break;
		case "setup.php":
			include 'pageinner/setupcontents.php'; 
		break;
		}
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