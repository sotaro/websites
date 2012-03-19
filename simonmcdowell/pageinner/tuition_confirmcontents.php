<?php
//Session Start
session_start();

$input_name = $_SESSION['tuition_form'] ['tui_name'];
$input_email = $_SESSION['tuition_form'] ['tui_email'];
$input_message = $_SESSION['tuition_form'] ['tui_message'];

if ($_SESSION['tuition_form'] ['check'] == "") {
	header("Location: tuition.php");
	exit;
}
?>

<h2>Drum Tuition</h2>
<form id="tuition_form" action="pageinner/tuition_edit.php" method="post">
<h3>Please confirm all the details below:</h3>
<p>Your name:<br />
<? echo $input_name; ?></p>
<p>Your Email:<br />
<? echo $input_email; ?></p>
<p>Message:<br />
<? echo $input_message; ?></p>
<p><input type="hidden" name="check" value="ok" /><a href="javascript:back();"><img src="img/btn_back.gif" width="91" height="36" alt="back" title="back" style="margin-right:10px;" /></a><input type="image" src="img/btn_submit.gif" alt="submit" title="submit" /></p>
</form>