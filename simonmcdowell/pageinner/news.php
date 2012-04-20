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

$max = 10;
if(array_key_exists('page',$_GET)) $page = (int)$_GET['page'];
else $page = 1;

$q = "select count(num) as num from news";
$r = mysql_query($q);
list($total) = mysql_fetch_row($r);
mysql_free_result($r);
$maxPage=(int)ceil($total/$max);
if($page>$maxPage) $page=$maxPage;
$q = "SELECT date,DATE_FORMAT(date,'%a')as day,news FROM news ORDER BY num desc limit ".(($page-1)*$max).",".$max;
$rs = mysql_query($q);

if($page===1) $prev = "&lt;&nbsp;Prev&nbsp;".$max;
else $prev = "<a href=\"news.php?page=".($page - 1)."\">&lt;&nbsp;Prev&nbsp;".$max."</a>";

if($page===$maxPage) $next = "Next&nbsp;".$max."&nbsp;&gt;";
else $next = "<a href=\"news.php?page=".($page + 1)."\">Next&nbsp;".$max."&nbsp;&gt;</a>";

?>

<h2>News</h2>
<div class="pagenum">
<?php echo "Page ".$page." / ".$maxPage; ?></div><div class="pagenavi">
<?php echo $prev." / ".$next; ?>
</div>
<br class="clear" />
<?php while ($row = mysql_fetch_array($rs)){
	if($row['date'])
		echo '<p class="itemlist"><span class="date">'.$row['date'].' ('.$row['day'].')</span><br />';
	echo $row['news']."</p>";
}
?>
<div class="pagenum">
<?php echo "Page ".$page." / ".$maxPage; ?></div><div class="pagenavi">
<?php echo $prev." / ".$next; ?>
</div><br class="clear" />
