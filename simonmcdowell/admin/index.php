<?php

include('myOpenID.php');
include('myCookie.php');
session_start();

if(array_key_exists("op",$_GET)){
	$my=new myOpenID();
	$my->authenticate("google","http://".$_SERVER['HTTP_HOST']."/admin/index.php",300,array("email"));
}
else if(array_key_exists("openid1_nonce",$_GET)){
	$my=new myOpenID();
	if(!$my->validate($msg)){
		error_log($msg);
		header("location: http://".$_SERVER['HTTP_HOST']."/admin");
		return;
	}
	mySetCookie();
}
else if(myCheckCookie()){
		header("location: http://".$_SERVER['HTTP_HOST']."/admin/news.php");
		return;
}
else{
	include 'header.html';
	echo '<h2>Login</h2>';
	echo '<a href="index.php?op=google">Login by Google Account</a>'; 
}
?>
</div>
</div>
</body>
</html>
