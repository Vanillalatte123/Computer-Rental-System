<?php # mysqli_connect.php

// This file contains the database access information. 
// This file also establishes a connection to MySQL, 
// selects the database, and sets the encoding.

// Set the database access information as constants:
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'computerrental');
date_default_timezone_set("Asia/Kuala_Lumpur");
$date = date('Y-m-d H:i:s');


// Make the connection:
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

$servername = "localhost";
$usr = "root";
$pwd = "";
$dbname = "computerrental";

// Create connection
$conn = new mysqli($servername, $usr, $pwd, $dbname);

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');