<?php
session_start();
if (!isset($_SESSION['user_id']) || isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header("Location: login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
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
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            color: #388e3c;
            margin-bottom: 20px;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        a, button {
            padding: 12px 20px;
            margin: 5px 0;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            max-width: 300px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        a:hover, button:hover {
            background-color: #388e3c;
        }
        .section {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Home</h1>
        <div class="button-container">
            <a href="user_dashboard.php">Go to User Dashboard</a>
            <a href="feedback_list.php">View Feedback</a>
            <a href="feedback_form.php">Give Feedback</a>
            <a href="support_list.php">View Support Tickets</a>
            <a href="support_form.php">Contact Support</a>
            <a href="profile/view.php">View Profile</a>
            <a href="leaderboard.php">Check leaderboard</a>
        </div>
        <div class="section">
            <div class="button-container">
                <a href="contact_form.php">Contact Us</a>
                <form method="POST" action="../Controller/logout.php">
                    <input type="hidden" name="action" value="logout">
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>