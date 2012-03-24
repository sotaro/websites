<?php

$db_name = "giftnzco_simn";
$table_name = "shows";

$connection = mysql_connect("localhost", "giftnzco_toshi", "mysqladmin") or die("Sorry, You couldn't connect to the database.");
mysql_select_db($db_name, $connection) or die("Sorry, You couldn't select the database.");

$num = $_GET{'item_num'};

$sql = "delete from $table_name where num = $num";
mysql_query($sql);
mysql_close($connection);

header ("Location: view_shows.php");
exit;

?>