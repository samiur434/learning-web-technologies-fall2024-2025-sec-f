<?php
session_start();
header('Content-Type: application/json');
require_once('../Model/userModel.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validation
    if (empty($username) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Username and Password cannot be empty."]);
        exit;
    }

    // Check credentials in the database
    $status = login($username, $password);
    if ($status) {
        setcookie('flag', 'true', time() + 3600, '/');
        $_SESSION['username'] = $username;

        echo json_encode(["success" => true, "message" => "Login successful! Redirecting..."]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid username or password."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit;
}
?>
