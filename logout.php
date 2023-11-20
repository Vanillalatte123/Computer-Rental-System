<?php

session_start();

if (!isset($_SESSION['userId'])) {

	require ('includes/loginFunction.inc.php');
	redirect_user();	
	
} else {

	$_SESSION = array();
	session_destroy();
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0);

}

$page_title = 'Logged Out!';
include ('includes/head.php');

echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";

include ('includes/foot.php');
?>