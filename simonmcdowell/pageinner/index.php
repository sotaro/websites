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
$rs = mysql_query("SELECT date,DATE_FORMAT(date,'%a') as day,news,num FROM news ORDER BY num desc limit 3");
echo '<p id="topnews">';
while($row = mysql_fetch_array($rs)){
	$n=$row['news'];
	$l=240;
	if(strlen($n) > $l){
		$n=substr($n,0,$l);
		$i=$l-1;
		while($n[$i]!==" ")$i--;
		$n=substr($n,0,$i)." ...";
	}
	$p=strpos($n,'<');
	if($p===0){
		$n='';
	}
	else if($p){
		$n=substr($n,0,$p);
		$i=$l-1;
		while($n[$i]!==" " && $i>0) $i--;
		$n=substr($n,0,$i)." ...";
	}
	echo '<span class="date">'.$row['date'].' ('.$row['day'].')</span><br />';
	echo $n.'&nbsp;&nbsp;&nbsp;<a href="news.php#'.$row['num'].'">>> see detail</a><br /><br />';
}
echo '<br /><a href="news.php">more news</a></p>';

// shows
$q="SELECT date,DATE_FORMAT(date,'%a') as day,start,end,venue,band,charge,site FROM shows ".
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
    echo 'Website: <a href=\"'.$row['site'].'\" target=\"_blank\">'.$row['site'].'</a></p>';
}
echo '<p><a href="shows.php">more shows</a></p>';

mysql_free_result($r);
mysql_close($dbh);

?>
