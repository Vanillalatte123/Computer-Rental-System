<?php 

session_start();

if (!isset($_SESSION['userId'])) {

	require ('includes/loginFunction.inc.php');
	redirect_user();	

}

$page_title = 'Logged In!';
include ('includes/head.php');

echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['firstName']}!</p>";

include ('includes/foot.php');
?>