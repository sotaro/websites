<? echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\r"; ?>
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
<li><img src="../img/admin_news.gif" width="36" height="15" alt="News" /></li><li><a href="add_news.php"><img src="../img/admin_btn_add.gif" width="32" height="15" alt="Add" /></a></li><li><a href="view_news.php"><img src="../img/admin_btn_view.gif" width="62" height="15" alt="View" /></a></li><li><img src="../img/admin_shows.gif" width="54" height="15" alt="Shows" /></li><li><img src="../img/admin_btn_add_c.gif" width="32" height="15" alt="Add" /></li><li><a href="view_shows.php"><img src="../img/admin_btn_view.gif" width="62" height="15" alt="View" /></a></li>
</ul>
</div>
<div id="contents">
<h2>Shows: Add</h2>
<form id="add_show" name="add_show" action="add_show_register.php" method="post">
<div class="form_container"><h3>Date &amp; Time</h3>
<select id="day" name="day">
<option value="1st" selected>1st</option>
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
<option value="Jan" selected>January</option>
<option value="Feb">February</option>
<option value="Mar">March</option>
<option value="Apr">April</option>
<option value="May">May</option>
<option value="Jun">June</option>
<option value="Jul">July</option>
<option value="Aug">August</option>
<option value="Sep">September</option>
<option value="Oct">October</option>
<option value="Nov">November</option>
<option value="Dec">December</option>
</select>&nbsp;&nbsp;<select id="year" name="year">
<option value="2007" selected>2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
</select><br />
<select id="theday" name="theday">
<option value="Sun" selected>Sunday</option>
<option value="Mon">Monday</option>
<option value="Tue">Tuesday</option>
<option value="Wed">Wednesday</option>
<option value="Thu">Thursday</option>
<option value="Fri">Friday</option>
<option value="Sat">Saturday</option>
</select>&nbsp;&nbsp;<input type="text" maxlength="7" id="time" name="time" class="timefield" value="8.00pm" /><br />
<input type="text" maxlength="12" id="ordercode" name="ordercode" class="textfield" value="200701012200" /></div>
<div class="form_container"><h3>Venue</h3>
<input type="text" maxlength="100" id="venue" name="venue" class="textfield" /></div>
<div class="form_container"><h3>Band</h3>
<input type="text" maxlength="100" id="band" name="band" class="textfield" /></div>
<div class="form_container"><h3>Door charge</h3>
<input type="text" maxlength="100" id="charge" name="charge" class="textfield" value="$" /></div>
<div class="form_container"><h3>Website of the venue</h3>
<input type="text" maxlength="100" id="url" name="url" class="textfield" value="http://" /></div>
<div class="form_container"><input type="reset" value="Clear" /></a> <input type="submit" value="Register" /></div>
</form>
</div>
</div>

</body>
</html>