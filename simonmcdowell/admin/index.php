<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="keywords" content="Drummer,Drum,Drum tutor,tutor,Simon,Simon McDowell" />
<meta name="description" content="" />
<link rel="stylesheet" href="style_admin.css" type="text/css" />
<title>www.simonmcdowell.com | Administration</title>
</head>
<body>
<div id="wrapper">
<div id="header">
<h1>Simon McDowell</h1>
<img src="../img/url.gif" width="162" height="16" alt="www.SimonMcDowell.com" /></div>
<div id="navi">&nbsp;</div>
<div id="contents">
<?php

include("myOpenID.php");
if(array_key_exists("op",$_GET)){
	session_start();
	$my=new myOpenID();
	$my->authenticate("google","http://simon.localhost/admin/index.php",300,array("email"));
}
else if(array_key_exists("openid1_nonce",$_GET)){
	session_start();
	$my=new myOpenID();
	if(!$my->validate($msg)){
		error_log($msg);
		header("location: http://simon.localhost/admin");
	}
	else echo "you're succeeded to login!";
}
else{
	echo '<h2>Log in by OpenID</h2>';
	echo '<a href="index.php?op=google"><img src="../images/layout/google-openid.jpg" width="225" height="141"alt="" border="0"></a>'; 
}
?>
</div></div></body></html>
