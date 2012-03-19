<?php
//Session Start
session_start();

//
$_SESSION['tuition_form'] ['tui_name'] = $_POST['tui_name'];
$_SESSION['tuition_form'] ['tui_email'] = $_POST['tui_email'];
$_SESSION['tuition_form'] ['tui_message'] = $_POST['tui_message'];
$_SESSION['tuition_form'] ['check'] = $_POST['check'];

$_SESSION['flag'] = "1";


if ($_SESSION['tuition_form'] ['check'] == "") {
	header("Location: tuition.php");
	exit;
}

$spamcheck = strpos ($_SESSION['tuition_form'] ['tui_message'],"href");

if ($spamcheck != false) {
	session_destroy();
	header("Location: ../index.php");
	exit;
}

// Check Name
$name = trim(mb_convert_kana($_SESSION['tuition_form'] ['tui_name'],"s","iso-8859-1"));
if ($name == "") {
	$error_name = "*Please input your name";
	$error_name_flag = "1";
} else {
	$error_name = "";
}

// Check Email
$email = trim(mb_convert_kana($_SESSION['tuition_form'] ['tui_email'],"sa","iso-8859-1"));
if ($email == "") {
	$error_email = "*Please input your email address";
	$error_email_flag = "1";
} else if (!ereg("^[0-9a-zA-Z_\.\-]+@[0-9a-zA-Z][0-9a-zA-Z\.\-]+$",$email)) {
	$error_email = "*Please input your email address correctly";
	$error_email_flag = "1";
} else {
	$error_email = "";
}

// Check Message
$message = trim(mb_convert_kana($_SESSION['tuition_form'] ['tui_message'],"s","iso-8859-1"));
if ($_SESSION['tuition_form'] ['tui_message'] == "") {
	$error_message = "*Please input your message";
	$error_message_flag = "1";
} else {
	$error_message = "";
}


$_SESSION['tuition_form'] ['tui_name'] = htmlspecialchars($name);
$_SESSION['tuition_form'] ['tui_email'] = htmlspecialchars($email);
$_SESSION['tuition_form'] ['tui_message'] = htmlspecialchars($message);

$_SESSION['error_name'] = $error_name;
$_SESSION['error_name_flag'] = $error_name_flag;
$_SESSION['error_email'] = $error_email;
$_SESSION['error_email_flag'] = $error_email_flag;
$_SESSION['error_message'] = $error_message;
$_SESSION['error_message_flag'] = $error_message_flag;

if ($_SESSION['error_name'] == "" && $_SESSION['error_email'] == "" && $_SESSION['error_message'] == "") {
	header ("Location: ../tuition_confirm.php");
	exit;

} else {
	header ("Location: ../tuition.php");
	exit;
}

?>