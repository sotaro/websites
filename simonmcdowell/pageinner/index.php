<?php

$db=$GLOBALS['___conf']['db'];
if(!$dbh = mysql_connect($db['host'],$db['user'],$db['pass'])){
	echo("Sorry, internal server error occured.");
	return;
}
if(!mysql_select_db($db['name'],$dbh)){
	mysql_close($dbh);
	echo("Sorry, internal server error occured.");
	return;
}
echo '<h2>Latest News</h2>';

// news
$rs = mysql_query("SELECT date,DATE_FORMAT(date,'%a') as day,news FROM news ORDER BY num desc limit 3");
while($row = mysql_fetch_array($rs)){
	echo '<p id="topnews"><span class="date">';
	echo $row['date'].' ('.$row['day'].')</span><br />';
	$n=$row['news'];
	$l=240;
	if(strlen($n) > $l){
		$n=substr($n,0,$l);
		$i=$l-1;
		while($n[$i]!==" ")$i--;
		$n=substr($n,0,$i)." ...";
	}
	echo $n.'<br />';
}
echo '<br /><a href="news.php">more news</a></p>';

// shows
$q="SELECT date,DATE_FORMAT(date,'%a') as day,start,end,venue,band,charge,url FROM shows ".
   "where date >= current_date ORDER BY date limit 3";
$r=mysql_query($q);
if(!mysql_num_rows($r)){
	mysql_close($dbh);
	return;
}
echo '<h2>Upcoming Shows</h2>';
while($row=mysql_fetch_array($r)){ 
	echo '<p class="itemlist"><span class="date">';
	echo $row['date'].' ('.$row['day'].') '.$row['start'].' - '.$row['end'].'</span><br />';
    echo 'Venue: ' .$row['venue']."<br />";
    echo 'Band/Artist: ' .$row['band']."<br />";
    echo 'Cost: ' .$row['charge']."<br />";
    echo 'Website: <a href=\"'.$row['url'].'\" target=\"_blank\">'.$row['url'].'</a></p>';
}
echo '<p><a href="shows.php">more shows</a></p>';

mysql_free_result($r);
mysql_close($dbh);

?>
