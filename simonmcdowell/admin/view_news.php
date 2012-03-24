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
	$next = "<a href=\"view_news.php?page=".($page + 1)."\">Next&nbsp;".$maxrow."&nbsp;&gt;</a>";
} else {
	$next = "Next&nbsp;".$maxrow."&nbsp;&gt;";
}
if ($page  >  0) {
	$prev = "<a href=\"view_news.php?page=".($page - 1)."\">&lt;&nbsp;Prev&nbsp;".$maxrow."</a>";
} else {
	$prev = "&lt;&nbsp;Prev&nbsp;".$maxrow;
}

$_SESSION['flag'] = "1";

?><? echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\r"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="keywords" content="Drummer,Drum,Drum tutor,tutor,Simon,Simon McDowell" />
<meta name="description" content="" />
<link rel="stylesheet" href="style_admin.css" type="text/css" />
<title>www.simonmcdowell.com | Administration</title>
</head>
<body>

<div id="wrapper">
<div id="header"><img src="../img/drummer_drumtutor.gif" width="176" height="23" alt="Drummer / Drum Tutor" />
<h1><img src="../img/simon_mcdowell.gif" width="224" height="44" alt="Simon McDowell" /></h1>
<img src="../img/url.gif" width="162" height="16" alt="www.SimonMcDowell.com" /></div>
<div id="navi">
<ul>
<li><img src="../img/admin_news.gif" width="36" height="15" alt="News" /></li><li><a href="add_news.php"><img src="../img/admin_btn_add.gif" width="32" height="15" alt="Add" /></a></li><li><img src="../img/admin_btn_view_c.gif" width="62" height="15" alt="View" /></li><li><img src="../img/admin_shows.gif" width="54" height="15" alt="Shows" /></li><li><a href="add_show.php"><img src="../img/admin_btn_add.gif" width="32" height="15" alt="Add" /></a></li><li><a href="view_shows.php"><img src="../img/admin_btn_view.gif" width="62" height="15" alt="View" /></a></li>
</ul>
</div>
<div id="contents">
<h2>News: View All</h2>

<p id="total">You have registered&nbsp;<strong><?php echo $num; ?></strong>&nbsp;news. <a href="../index.php">&gt;Back to website</a></p>
<div class="pagenum">Page <?php echo ($page + 1); ?>&nbsp;/&nbsp;<?php echo $numOfPage; ?></div><div class="pagenavi"><?php echo $prev; ?> / <?php echo $next; ?></div><br class="clear" />

<? while ($row = mysql_fetch_array($rs)) { ?>
<p class="itemlist"><span class="date"><? echo $row['day']; ?>&nbsp;<? echo $row['month']; ?>&nbsp;<? echo $row['year']; ?></span><br />
<? echo $row['news']; ?><br />
<a href="delete_news.php?item_num=<?php echo $row['num']; ?>"><img src="../img/admin_delete.gif" width="51" height="15" alt="Delete this news" /></a></p>

<?php } ?>

<div class="pagenum">Page <?php echo ($page + 1); ?>&nbsp;/&nbsp;<?php echo $numOfPage; ?></div><div class="pagenavi"><?php echo $prev; ?> / <?php echo $next; ?></div><br class="clear" />

</div>
</div>

</body>
</html>