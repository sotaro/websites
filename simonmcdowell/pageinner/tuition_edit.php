<?php
//Session Start
session_start();

//Send email
$to = "the_moa_special@hotmail.com,simon@simonmcdowell.com";
$subject = "Drum Tuition Inquiry";
$msg = "--------------------------------------------\n\n";
$msg .= "  " .$_SESSION['tuition_form'] ['tui_name']. "\n\n";
$msg .= "  Email: " .$_SESSION['tuition_form'] ['tui_email']. "\n\n";
$msg .= "--------------------------------------------\n\n";
$msg .= "\n\n";
$msg .= "  Message:\n\n";
$msg .= "  " .$_SESSION['tuition_form'] ['tui_message']. "\n\n";

$mailheaders = "From: SimonMcDowell.com\r\n";
$mailheaders .= "Reply-To: " .$_SESSION['tuition_form'] ['tui_email']. "\r\n";
$mailheaders .= "Errors-To: the_moa_special@hotmail.com\r\n";
$mailheaders .= "MIME-Version: 1.0\r\n";
$mailheaders .= "Content-type: text/plain; charset=\"EUC-JP\"\r\n";
$mailheaders .= "Content-Transfer-Encoding: 7bit\r\n";
$mailheaders .= "X-Mailer: PHP/".phpversion()."\r\n"; 

mail($to, $subject, $msg, $mailheaders);


// Redirect to tuition_thankyou.html
session_destroy();
header ("Location: ../tuition_thanks.php");
exit;

?>