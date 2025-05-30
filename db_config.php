<?php
// db_config.php

// Database credentials
$servername = "localhost";
$username   = "root";
$password   = "";           // no password
$dbname     = "heartcare_connect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// You can now use $conn in your scripts to query the database.
?>
