<?php
session_start();
require_once '../config/db.php';

$conn = new mysqli("127.0.0.1", "root", "", "agriculture");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        $_SESSION['error'] = "Username and password are required.";
        header("Location: ../view/login_form.php");
        exit();
    }

    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Admin login - updated credentials
    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['username'] = 'admin';
        $_SESSION['is_admin'] = true;
        $_SESSION['user_id'] = 1; // Assuming admin user_id is 1
        header("Location: ../view/admin_home.php");
        exit();
    }

    if ($username === 'adminquiz' && $password === 'adminquiz') {
        $_SESSION['username'] = 'admin';
        $_SESSION['is_admin'] = true;
        $_SESSION['user_id'] = 1; // Assuming admin user_id is 1
        header("Location: ../view/home.html");
        exit();
    }


    // User login
    $query = "SELECT id, name, password FROM users WHERE name = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {  // Directly compare plain text passwords
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['is_admin'] = false;
            header("Location: ../view/user_home.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid password";
            header("Location: ../view/login_form.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid username";
        header("Location: ../view/login_form.php");
        exit();
    }
}
?>