<?php

// Database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "big-squid-booking";

$connection = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_errno()) {
    die("failed to connect with mySQL: " . mysqli_connect_error());
}
