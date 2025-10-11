<?php
$host = "localhost";
$user = "root"; // your phpMyAdmin username
$pass = "";     // your phpMyAdmin password (if any)
$db   = "mze_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
