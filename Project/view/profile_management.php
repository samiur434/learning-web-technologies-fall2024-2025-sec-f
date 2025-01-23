<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Management</title>
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
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
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
        <h1>Profile Management</h1>
        <div class="button-container">
            <a href="profile/view.php">View Profile</a>
            <a href="profile/edit.php">Edit Profile</a>
        </div>
    </div>
</body>
</html>