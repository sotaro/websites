<?php

include('myCookie.php');
include('myFile.php');
session_start();

if(!myCheckCookie()){
		header("location: http://".$_SERVER['HTTP_HOST']."/admin/index.php");
		return;
}

$bio=new myFile("bio",array("en","jp"));
$bio->run();

?>
