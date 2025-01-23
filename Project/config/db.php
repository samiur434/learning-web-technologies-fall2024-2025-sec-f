<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$db_name = 'agriculture';

$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
