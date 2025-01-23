<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../view/login_form.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 10px 0;
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
        <h1>User Dashboard</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        <ul>
            <li><a href="user_courselist.php">Course List</a></li>
            <li><a href="user_enrollments.php">Enrollments</a></li>
            <li><a href="user_savedcourses.php">Saved Courses</a></li>
            <li><a href="support_list.php">Support</a></li>
            <li><a href="feedback_list.php">Feedback</a></li>
            <li><a href="../Controller/logout.php">Logout</a></li>
           

        </ul>
    </div>
</body>
</html>