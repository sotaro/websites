<?php
//Session Start
session_start();

//
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$theday = $_POST['theday'];
$time = $_POST['time'];
$ordercode = $_POST['ordercode'];
$venue = htmlspecialchars($_POST['venue']);
$band = htmlspecialchars($_POST['band']);
$charge = htmlspecialchars($_POST['charge']);
$url = htmlspecialchars($_POST['url']);

//Connect to Database
$db_name = "giftnzco_simn";
$table_name = "shows";

$connection = mysql_connect("localhost", "giftnzco_toshi", "mysqladmin") or die("Sorry, You couldn't connect to the database.");
mysql_select_db($db_name, $connection) or die("Sorry, You couldn't select the database.");

$sql = "insert into $table_name (day,month,year,theday,time,ordercode,venue,band,charge,url) values ('$day','$month','$year','$theday','$time','$ordercode','$venue','$band','$charge','$url')";

$res = mysql_query($sql);
mysql_close($connection);

// Redirect
header ("Location: view_shows.php");
exit;

?>