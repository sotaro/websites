<?php
//Session Start
session_start();

//
$_SESSION['add_news'] ['day'] = $_POST['day'];
$_SESSION['add_news'] ['month'] = $_POST['month'];
$_SESSION['add_news'] ['year'] = $_POST['year'];
$_SESSION['add_news'] ['news'] = $_POST['news'];

$_SESSION['flag'] = "1";

?>
<? echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\r"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="keywords" content="Drummer,Drum,Drum tutor,tutor,Simon,Simon McDowell" />
<meta name="description" content="" />
<link rel="stylesheet" href="style_admin.css" type="text/css" />
<title>www.simonmcdowell.com | Administration</title>
</head>
<body>

<div id="wrapper">
<div id="header"><img src="../img/drummer_drumtutor.gif" width="176" height="23" alt="Drummer / Drum Tutor" />
<h1><img src="../img/simon_mcdowell.gif" width="224" height="44" alt="Simon McDowell" /></h1>
<img src="../img/url.gif" width="162" height="16" alt="www.SimonMcDowell.com" /></div>
<div id="navi">
</div>
<div id="contents">
<h2>Add News</h2>
<form id="add_news_confirm" name="add_news_confirm" action="add_news_register.php" method="post">
<p><span class="date"><? echo($_SESSION['add_news'] ['day']) ?> <? echo($_SESSION['add_news'] ['month']) ?> <? echo($_SESSION['add_news'] ['year']) ?></span><br />
<? echo ($_SESSION['add_news'] ['news']) ?></p>
<div class="form_container">
<a href="javascript:back();"><input type="button" value="Back" /></a> <input type="submit" value="Register" /></div>
</form>
</div>
</div>

</body>
</html>