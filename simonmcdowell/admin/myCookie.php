<?php

function mySetCookie(){
	$i=hash("crc32",$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
	$_SESSION[$i]=rand();
	$s=hash("ripemd320",$_SESSION[$i]);
	setcookie("___i",$i);
	setcookie("___s",$s);
	header("location: http://".$_SERVER['HTTP_HOST']."/admin");
}

function myCheckCookie(){
	if(!array_key_exists('___i',$_COOKIE)) return FALSE;
	if(!array_key_exists('___s',$_COOKIE)) return FALSE;
	if($_COOKIE['___i']!==hash("crc32",$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'])) return FALSE;
	if($_COOKIE['___s']!==hash("ripemd320",$_SESSION[$_COOKIE['___i']])) return FALSE;
	return TRUE;
}

