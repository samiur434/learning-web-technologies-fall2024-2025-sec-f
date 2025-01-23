<?php
session_start();
require_once "../../config/db.php";
require_once "../../model/profileModel.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_form.php");
    exit();
}

$user = getUserById($conn, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #388e3c;
        }
        p {
            color: #555;
        }
        a, button {
            padding: 10px;
            margin: 5px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            display: block;
        }
        a:hover, button:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profile Details</h1>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <a href="edit.php">Edit Profile</a>
        <br><br>
        <a href="../user_home.php">Back to Home</a>
    </div>
</body>
</html>