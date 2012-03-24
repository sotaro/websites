<?php

session_start();

if ($_POST['pw'] != "simon" && $_SESSION['flag'] != 1) {
	header ("Location: index.php");
	exit;
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
<li><img src="../img/admin_news.gif" width="36" height="15" alt="News" /></li><li><img src="../img/admin_btn_add_c.gif" width="32" height="15" alt="Add" /></li><li><a href="view_news.php"><img src="../img/admin_btn_view.gif" width="62" height="15" alt="View" /></a></li><li><img src="../img/admin_shows.gif" width="54" height="15" alt="Shows" /></li><li><a href="add_show.php"><img src="../img/admin_btn_add.gif" width="32" height="15" alt="Add" /></a></li><li><a href="view_shows.php"><img src="../img/admin_btn_view.gif" width="62" height="15" alt="View" /></a></li>
</ul>
</div>
<div id="contents">
<h2>News: Add</h2>
<form id="add_news" name="add_news" action="add_news_register.php" method="post">
<div class="form_container"><h3>Release Date</h3>
<select id="day" name="day">
<option value="" selected>Day</option>
<option value="1st">1st</option>
<option value="2nd">2nd</option>
<option value="3rd">3rd</option>
<option value="4th">4th</option>
<option value="5th">5th</option>
<option value="6th">6th</option>
<option value="7th">7th</option>
<option value="8th">8th</option>
<option value="9th">9th</option>
<option value="10th">10th</option>
<option value="11th">11th</option>
<option value="12th">12th</option>
<option value="13th">13th</option>
<option value="14th">14th</option>
<option value="15th">15th</option>
<option value="16th">16th</option>
<option value="17th">17th</option>
<option value="18th">18th</option>
<option value="19th">19th</option>
<option value="20th">20th</option>
<option value="21st">21st</option>
<option value="22nd">22nd</option>
<option value="23rd">23rd</option>
<option value="24th">24th</option>
<option value="25th">25th</option>
<option value="26th">26th</option>
<option value="27th">27th</option>
<option value="28th">28th</option>
<option value="29th">29th</option>
<option value="30th">30th</option>
<option value="31st">31st</option>
</select>&nbsp;&nbsp;<select id="month" name="month">
<option value="" selected>Month</option>
<option value="Jan">Jan</option>
<option value="Feb">Feb</option>
<option value="Mar">Mar</option>
<option value="Apr">Apr</option>
<option value="May">May</option>
<option value="Jun">Jun</option>
<option value="Jul">Jul</option>
<option value="Aug">Aug</option>
<option value="Sep">Sep</option>
<option value="Oct">Oct</option>
<option value="Nov">Nov</option>
<option value="Dec">Dec</option>
</select>&nbsp;&nbsp;<select id="year" name="year">
<option value="" selected>Year</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
</select></div>
<div class="form_container"><h3>News</h3>
<textarea id="news" name="news" rows="8"></textarea></div>
<div class="form_container"><input type="reset" value="Clear" /></a> <input type="submit" value="Register" /></div>
</form>
</div>
</div>

</body>
</html>