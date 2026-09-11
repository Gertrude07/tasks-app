<?php
// Copy this file to db.php and fill in your real credentials.
// db.php is excluded from Git via .gitignore.

$host = "localhost";
$db_user = "your_username";
$db_pass = "your_password";
$db_name = "your_database_name";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
