<?php
$servername = "localhost";
$username = "123";
$password = "wo44Ud0^1";
$dbname = "JournalJoy_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
