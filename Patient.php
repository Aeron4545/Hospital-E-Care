<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "doctors";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check the connection
if (!$con) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>