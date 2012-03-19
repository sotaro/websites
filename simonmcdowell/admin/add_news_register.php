<?php
//Session Start
session_start();

//
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$news = htmlspecialchars($_POST['news']);

//Connect to Database
$db_name = "giftnzco_simn";
$table_name = "news";

$connection = mysql_connect("localhost", "giftnzco_toshi", "mysqladmin") or die("Sorry, You couldn't connect to the database.");
mysql_select_db($db_name, $connection) or die("Sorry, You couldn't select the database.");

$sql = "insert into $table_name (day,month,year,news) values ('$day','$month','$year','$news')";

$res = mysql_query($sql);
mysql_close($connection);

// Redirect
header ("Location: view_news.php");
exit;

?>