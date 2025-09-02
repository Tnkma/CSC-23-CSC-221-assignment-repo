<?php

$servername = "localhost";
$username = "student_user"; 
$password = "mypassword";
$dbname = "student_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8
$conn->set_charset("utf8");

// Set time zone
date_default_timezone_set("Africa/Lagos");
?>
