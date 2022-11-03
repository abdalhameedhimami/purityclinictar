<?php
$webmaster_email = "purityclinic9@gmail.com";
$feedback_page = "feedback_form.html";
$error_page = "error_message.html";
$thankyou_page = "thank_you.html";
$email_address = $_REQUEST['email_address'] ;
$comments = $_REQUEST['comments'] ;
function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if (!isset($_REQUEST['email_address'])) {
header( "Location: $feedback_page" );
}

elseif (empty($email_address) || empty($comments)) {
header( "Location: $error_page" );
}

elseif ( isInjected($email_address) ) {
header( "Location: $error_page" );
}

else {
mail( "$webmaster_email", "Feedback Form Results",
  $comments, "From: $email_address" );
header( "Location: $thankyou_page" );
}
?>