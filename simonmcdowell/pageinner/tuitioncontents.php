<?php

//Session Start
session_start();
$input_name="";
$e_name="";
$input_email="";
$e_email="";
$input_message="";
$e_message="";
$_SESSION['tuition_form']="";
$_SESSION['error_message_flag']="";

if ($_SESSION['flag'] == "1") {
	$input_name = $_SESSION['tuition_form'] ['tui_name'];
	$input_email = $_SESSION['tuition_form'] ['tui_email'];
	$input_message = $_SESSION['tuition_form'] ['tui_message'];
	
	if ($_SESSION['error_name_flag'] == "1") {
		$e_name = "<br />\r<span class=\"error\">";
		$e_name .= $_SESSION['error_name'];
		$e_name .= "</span>\r";
	} else {
		$e_name = "";
	}
	if ($_SESSION['error_email_flag'] == "1") {
		$e_email = "<br />\r<span class=\"error\">";
		$e_email .= $_SESSION['error_email'];
		$e_email .= "</span>\r";
	} else {
		$e_email = "";
	}
	if ($_SESSION['error_message_flag'] == "1") {
		$e_message = "<br />\r<span class=\"error\">";
		$e_message .= $_SESSION['error_message'];
		$e_message .= "</span>\r";
	} else {
		$e_message = "";
	}
}
$_SESSION['flag'] = "0";
?>



<h2>Drum Tuition</h2>
<p>I can teach you all kinds of styles and can teach you exactly what would apply to your playing and correct any of your bad habits!</p>
<p>I have had a ton of experience in the professional world of music and can get serious, ambitious drummers learning more rapidly to reach their goal in trying to make a living in music!</p>
<p>I teach at Studio Grand Bleu in Hatagaya which is located on the Keio New Line 2 stops from Shinjuku Station.</p>
<p>I teach for <strong>4000YEN an hour (including studio fee)</strong> or if I were to come to you it would be <strong>3000YEN (plus transportation cost from Shinjuku)</strong></p>
<p>私はプロの音楽の世界での経験が豊富なので、趣味レベルで始めたい方から、真剣にプロを目指している方までどなたでもオッケーです！</p>
<p>レッスンは、幡ケ谷駅付近のスタジオで行います。新宿駅から京王線で2駅です。</p>
<p>授業料は、スタジオ費込で<strong>1時間4000円</strong>、もし出張レッスンをご希望でしたら、<strong>3000円プラス交通費</strong>です。</p>
<form id="tuition_form" action="pageinner/tuition_check.php" method="post">
<h3>Please fill in the details below:</h3>
<p><label for="tui_name">Your name</label>:<br />
<input type="text" id="tui_name" name="tui_name" class="form_txt" tabindex="1" alt="Your Name" value="<? echo $input_name; ?>" /><? echo $e_name; ?></p>
<p><label for="tui_email">Your Email</label>:<br />
<input type="text" id="tui_email" name="tui_email" class="form_txt" tabindex="2" alt="Your Email" value="<? echo $input_email; ?>" /><? echo $e_email; ?></p>
<p><label for="tui_message">Message</label>:<br />
<textarea tabindex="3" id="tui_message" name="tui_message" rows="8" tabindex="3"><? echo $input_message; ?></textarea><? echo $e_message; ?></p>
<p><input type="hidden" name="check" value="ok" /><input type="image" src="img/btn_submit.gif" alt="submit" title="submit" /></p>
</form>