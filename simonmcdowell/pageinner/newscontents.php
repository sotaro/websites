
<?php

session_start();

$db_name = "giftnzco_simn";
$table_name = "news";

$maxrow = 10;
$page = 0 + $_GET['page'];

$connection = mysql_connect("localhost", "giftnzco_toshi", "mysqladmin") or die("Sorry, You couldn't connect to the database.");
mysql_select_db($db_name, $connection) or die("Sorry, You couldn't select the database.");

$sql = "select count(num) as num from $table_name";
$rs = mysql_query($sql);
list($num) = mysql_fetch_row($rs);
mysql_free_result($rs);

$rs = mysql_query("SELECT * FROM $table_name ORDER BY num desc limit ".($page * $maxrow).", $maxrow");

$numOfPage = ceil($num / $maxrow);

if ($num > (($page + 1) * $maxrow)) {
	$next = "<a href=\"news.php?page=".($page + 1)."\">Next&nbsp;".$maxrow."&nbsp;&gt;</a>";
} else {
	$next = "Next&nbsp;".$maxrow."&nbsp;&gt;";
}
if ($page  >  0) {
	$prev = "<a href=\"news.php?page=".($page - 1)."\">&lt;&nbsp;Prev&nbsp;".$maxrow."</a>";
} else {
	$prev = "&lt;&nbsp;Prev&nbsp;".$maxrow;
}

$_SESSION['flag'] = "1";

?>

<h2>News</h2>
<div class="pagenum">
		Page <?php echo ($page + 1); ?>&nbsp;/&nbsp;<?php echo $numOfPage; ?></div><div class="pagenavi"><?php echo $prev; ?> / <?php echo $next; ?>
</div>
        <br class="clear" />
<? while ($row = mysql_fetch_array($rs)) { ?>
<p class="itemlist"><span class="date"><? echo $row['day']; ?>&nbsp;<? echo $row['month']; ?>&nbsp;<? echo $row['year']; ?></span><br />
<? echo $row['news']; ?></p>

<?php } ?>
<div class="pagenum">Page <?php echo ($page + 1); ?>&nbsp;/&nbsp;<?php echo $numOfPage; ?></div><div class="pagenavi"><?php echo $prev; ?> / <?php echo $next; ?></div><br class="clear" />